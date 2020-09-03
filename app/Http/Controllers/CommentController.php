<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\News $news
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        $comments = $news->comments()->latest()->paginate(config('news.per_page'));

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News $news
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, News $news)
    {
        $this->validate($request, [
            'name' => 'bail|required|string|max:255',
            'comment' => 'bail|required|string',
        ]);

        $comment = $news->comments()->create($request->all());

        return new JsonResponse($comment, JsonResponse::HTTP_CREATED);
    }
}
