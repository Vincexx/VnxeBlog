<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name'
    ];

    public function posts() {

        return $this->hasMany(Post::class);

    }
}
