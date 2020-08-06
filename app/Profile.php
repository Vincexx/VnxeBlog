<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'bio',
        'work',
        'place_of_work',
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }

}
