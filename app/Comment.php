<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
       'cuerpo',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function question()
    {
    	return $this->belongsTo('App\Question','user_id');
    }
}
