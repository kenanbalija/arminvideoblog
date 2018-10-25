<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    /**
     * Get the comments for the blog post.
     */

    // laksi nacin pristpa KOMENTARIMA koji su vezani ID-om za ovaj POST
    public function comments()
    {
        // samo ime ti kaze da ovaj post ima MNOGO komentara koji mu pripadaju
        return $this->hasMany('App\Comment');
    }

}
