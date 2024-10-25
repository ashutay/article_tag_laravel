<?php

namespace App\Models;

use App\Builders\ArticleBuilder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('attached_at');
    }

    public function newEloquentBuilder($query): ArticleBuilder
    {
        return new ArticleBuilder($query);
    }
}
