<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UserPostController extends Controller
{

    public function details()
    {
        $users = User::where('id', auth()->user()->id)->paginate(10);

        return view('user.posts.details', [
            'users' => $users
        ]);
    }




    ///////BOOKINGS///////
//Display logged in users users bookings
    //manage bookings
    public function bookings()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->paginate(10);

        return view('user.posts.bookings', [
            'bookings' => $bookings,
            'bookings' => $bookings->where('checkout', '>=', Carbon::today()),
            'expired' => $bookings->where('checkout', '<=', Carbon::today())
        ]);
    }


    public function editBooking(Booking $booking)
    {
        return view('user.posts.editbooking', ['booking' => $booking]);
    }


    public function updateBooking(Booking $booking)
    {
        $maxGuests = $booking->maxGuests;
            $attributes = request()->validate([
            'guests' => 'required|gt:0|max:'.$maxGuests,
            'checkin' => 'required|after:tomorrow',
            'checkout' => 'required|after:checkin'
        ]);

        $booking->update($attributes);

        return back()->with('success', 'Booking Updated!');
    }


    public function destroyBooking(Booking $booking)
    {
        $booking->delete();

        return back()->with('success', 'Booking Deleted!');
    }
}