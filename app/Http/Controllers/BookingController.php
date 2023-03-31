<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Validation\Rule;
use DateTime;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        //Calculate totalDays
        $start = $request->checkin;
        $end = $request->checkout;

        $checkin = new DateTime($start);
        $checkout = new DateTime($end);
        
        $days = $checkin->diff($checkout);
        $totalDays = $days->format('%a');

        //Calculate totalCost
        $costPerNight = $request->costPerNight;
        $maxGuests = $request->maxGuests;
        $totalCost = $totalDays * $costPerNight;

        $attributes = request()->validate([
            'post_id' => ['required', Rule::exists('posts', 'id')],
            'guests' => 'required',
            'checkin' => 'required|after:tomorrow',
            'checkout' => 'required|after:checkin'
        ]);

        //add attributes to booking
        $attributes['user_id'] = auth()->id();
        $attributes['totalDays'] = $totalDays;
        $attributes['costPerNight'] = $costPerNight;
        $attributes['maxGuests'] = $maxGuests;
        $attributes['totalCost'] = $totalCost;


        //Check if dates are unavailable
        $unavailable = Booking::where('post_id',request('post_id'))
            ->whereDate('checkin', '<=', $end)
            ->whereDate('checkout', '>=', $start)
            ->exists();

        //check if booking dates exist for another cottage    
        $bookingClash = Booking::where('user_id',$request->user_id) 
            ->whereDate('checkin', '<=', $end)
            ->whereDate('checkout', '>=', $start)
            ->exists();   

            if ($unavailable)
            {
                return back()->with('success', 'Dates Unavailable');
            }

            elseif ($bookingClash)
            {
                return back()->with('success', 'You already have a booking for another 
                cottage on these dates');
            }

            else{
                Booking::create($attributes);
                return redirect('/user/posts/bookings')
                ->with('success', 'Your booking has been created.');
            }
    }
}