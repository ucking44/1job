<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class Product extends Model
{
    use Moderatable;

    protected $fillable = ['user_id', 'name', 'detail'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
