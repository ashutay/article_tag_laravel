<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('attached_at')->withTimestamps;
    }
}
