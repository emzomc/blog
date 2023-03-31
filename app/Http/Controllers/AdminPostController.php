<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminPostController extends Controller
{
    //ALL COTTAGES PAGE
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    //CREATE POST PAGE
    public function create()
    {
        return view('admin.posts.create',);
    }

    //STORE POST DATA
    public function store()
    {
            $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'area_id' => ['required', Rule::exists('areas', 'id')],
            'address' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'maxGuests' => 'required',
            'numBedrooms' => 'required',
            'numBathrooms' => 'required',
            'costPerNight' => 'required'
        ]);
        
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);
        return redirect('/');
    }

    //EDIT POST
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    //UPDATE POST
    public function update(Post $post)
    {
            $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'area_id' => ['required', Rule::exists('areas', 'id')],
            'address' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'maxGuests' => 'required',
            'numBedrooms' => 'required',
            'numBathrooms' => 'required',
            'costPerNight' => 'required'
        ]);

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    //DELETE POST
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }







    
    //DISPLAY ALL USERS
    public function users()
    {
        return view('admin.posts.users', [
            'users' => User::paginate(50)
        ]);
    }


    //DELETE USER
    public function remove(User $user)
    {
        if ($user->isAdmin == 1) {
            return back()->with('success', 'You cannot delete admin user');
        }
        else{
            $user->delete();

        return back()->with('success', 'User Deleted!');
        }
    }









    ///////BOOKINGS///////
    //DISPLAY ALL BOOKINGS - EXPIRED AND ACTIVE
    public function bookings()
    {
        return view('admin.posts.bookings', [
            'bookings' => Booking::paginate(50)->where('checkout', '>=', Carbon::today()),
            'expired' => Booking::paginate(50)->where('checkout', '<=', Carbon::today())
        ]);
    }


    //single user booking
    public function userBooking($id)
        {
            $user = User::find($id);
            $bookings = Booking::where('user_id', $user->id)->get();
            
            return view('admin.posts.userbooking', [
                'bookings' => $bookings->where('checkout', '>=', Carbon::today()),
                'expired' => $bookings->where('checkout', '<=', Carbon::today())
            ]);
        }


    //EDIT BOOKING
    public function editBooking(Booking $booking)
        {
            return view('admin.posts.editbooking', ['booking' => $booking]);
        }

    //UPDATE BOOKING
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

    //DELETE BOOKING
        public function destroyBooking(Booking $booking)
        {
            $booking->delete();

            return back()->with('success', 'Booking Deleted!');
        }
    }
