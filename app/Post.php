<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'image_path_aws',
    ];

    public function category() {

        return $this->belongsTo(Category::class);

    }

    public function user()
    {

        return $this->belongsTo(User::class);
        
    }

}
