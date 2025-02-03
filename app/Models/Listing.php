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
}
