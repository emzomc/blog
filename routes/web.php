<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

//Home
Route::get('/', [PostController::class, 'index'])->name('home');

//Cottages
Route::get('cottages', [PostController::class, 'cottages']);

//Posts
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//Register
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

//Login
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
//Logout
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//Admin - Cottage Post Control
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');

//Admin User Control
Route::get('admin/posts/users', [AdminPostController::class, 'users'])->middleware('admin');
Route::delete('admin/posts/users/{user}', [AdminPostController::class, 'remove'])->middleware('admin');

//Admin Bookings Control
Route::get('admin/posts/bookings', [AdminPostController::class, 'bookings'])->middleware('admin');
Route::get('admin/posts/bookings/{booking}/edit', [AdminPostController::class, 'editBooking'])->middleware('admin');
Route::patch('admin/posts/bookings/{booking}', [AdminPostController::class, 'updateBooking'])->middleware('admin');
Route::delete('admin/posts/bookings/{booking}', [AdminPostController::class, 'destroyBooking'])->middleware('admin');
//Admin User Booking
Route::get('admin/posts/userbooking/{booking}', [AdminPostController::class, 'userBooking'])->middleware('admin');

//User Panel
Route::get('user/posts/details', [UserPostController::class, 'details'])->middleware('user');
Route::get('user/posts/bookings', [UserPostController::class, 'bookings'])->middleware('user');

//User Bookings Control
Route::get('user/posts/bookings', [UserPostController::class, 'bookings'])->middleware('user');
Route::get('user/posts/bookings/{booking}/edit', [UserPostController::class, 'editBooking'])->middleware('user');
Route::post('booking', [BookingController::class, 'store'])->middleware('user');
Route::patch('user/posts/bookings/{booking}', [UserPostController::class, 'updateBooking'])->middleware('user');
Route::delete('user/posts/bookings/{booking}', [UserPostController::class, 'destroyBooking'])->middleware('user');

//Review
Route::post('posts/{post:slug}/review', [PostCommentsController::class, 'store'])->middleware('user');