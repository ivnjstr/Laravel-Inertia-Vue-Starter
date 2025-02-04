<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //firts create a fillable array 
    protected $fillable = [
        // this is going to be an array with all the properties that needs to be filled through form or some other sources
        'title',
        'desc',
        'tags',
        'email',
        'link',
        'image',
        'approved',
    ];

    //another public function
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Specifies that the current model is associated with a single User



    //create another function for filtering
    public function scopeFilter($query, array $filters){
        //because we want a multiple filter keep this in an array > means this $filter is going to be an array
        //in this body we will apply our where statement before that dd first 
        //dd(request());
        //now apply where statement 

        if ($filters['search'] ?? false){
            //if this exist $filters['search'] use it then otherwise false to prevent error page if theres search
            $query
                ->where('title', 'like' , '%'. request('search') .'%')
                ->orWhere('desc', 'like' , '%'. request('search') .'%');
            //grap the $query builder which represent our Listings
        }


    }
    //naming is important because the word scope is a trigger for laravel to recognize this as a query builder for your model and whatever you pass after the word which is the Filter is going to be the name of your function that you would use in controller 
}
