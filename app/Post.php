<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body'
    ];


    public function user() {

        //look at it like: "$This post belongs to User"
        return $this->belongsTo('App\User');

    }

    public function photo() {
        
        return $this->belongsTo('App\Photo');

    }

    public function category() {

        return $this->belongsTo('App\Category');

    }


}
