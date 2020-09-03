<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $news = News::query()->latest()->paginate(config('news.per_page'));

        return NewsResource::collection($news);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\News $news
     *
     * @return \App\Http\Resources\News
     */
    public function show(News $news)
    {
        return NewsResource::make($news->load('comments'));
    }
}
