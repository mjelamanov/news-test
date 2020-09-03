<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'content', 'picture'];
}
