<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    // laksi nacin pristpa BLOG POSTOVIMA koji su vezani ID-om za ovaj komentar
    public function post()
    {
        // samo ime ti kaze da ovaj komentar pripada useru nekom, tj onaj field post_id
        return $this->belongsTo('App\Post');
    }

    // laksi nacin pristpa USERIMA koji su vezani ID-om za ovaj komentar
    public function user()
    {
        // samo ime ti kaze da ovaj USER pripada useru nekom, tj onaj field USER_ID
        return $this->belongsTo('App\User');
    }

}
