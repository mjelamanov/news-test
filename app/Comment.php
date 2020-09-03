<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'comment', 'news_id'];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
