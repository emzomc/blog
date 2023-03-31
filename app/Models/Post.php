<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'area', 'location'];

    public function scopeFilter($query, array $filters)
    {
//COTTAGES PAGE 
//search
        $query->when($filters['search'] ?? false, fn ($query, $search) => 
        $query->where(fn($query) =>
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

//accomodation type filter
        $query->when($filters['category'] ?? false, fn ($query, $category) => 
            $query->whereHas('category', fn ($query) =>
            $query->where('slug', $category)
            )
        );

//area type filter
        $query->when($filters['area'] ?? false, fn ($query, $area) => 
            $query->whereHas('area', fn ($query) =>
            $query->where('area_slug', $area)
            )
        );


//HOME PAGE
//No. of Guests Search
        $query->when($filters['guests'] ?? false, fn ($query, $guests) => 
        $query->where(fn($query) =>
            $query->where('maxGuests', '>=', $guests)
            )
        );

//location Search
        $query->when($filters['location'] ?? false, fn ($query, $location) => 
        $query->whereHas('location', fn ($query) =>
            $query->where('area_name', $location)
            )
        );
    }        
    

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function location()
    {
        return $this->belongsTo(Area::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}