<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'content', 'picture'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
