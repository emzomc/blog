<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Area;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();
        $guests = $request->old('guests');

        return view('posts.index', [
            'locations' => Area::all(),
            'accomodations' => Category::all(),
            'posts' => Post::latest()->filter(
                    request(['category', 'guests', 'area'])
                )->paginate(6)->withQueryString(),
        ]);
    }


    public function show(Post $post)
    {
        $booking = Booking::where('post_id', $post->id)->get();

        $id = Auth::id();
        
        //checkout date passes - user can leave review
        $checkoutDateReview = Booking::where('user_id', $id)
        ->where('post_id', $post->id)
        ->where('checkout', '<=', Carbon::now())
        ->exists();


        return view('posts.show', [
            'post' => $post,
            'bookings' => $booking,
            'checkoutDateReview' => $checkoutDateReview
        ]);
    } 
    
        
    
    public function cottages()
    {
        return view('posts.cottages', [
            'posts' => Post::latest()->filter(
                    request(['search', 'category', 'area'])
                )->paginate(6)
        ]);
    }

}