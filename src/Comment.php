<?php

namespace Hosein\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'id','message','name','email','like','dislike','parent','status'
    ];
}
