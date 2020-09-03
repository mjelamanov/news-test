<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Comment;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $comments = Comment::latest()->paginate($perPage);
        } else {
            $comments = Comment::latest()->paginate($perPage);
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.comments.create', ['news' => $this->getNews()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'news_id' => 'bail|required|integer|exists:news,id',
            'name' => 'bail|required|string',
            'comment' => 'bail|required|string',
        ]);

        Comment::create($request->all());

        return redirect('admin/comments')->with('flash_message', 'Comment added!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Comment $comment
     *
     * @return \Illuminate\View\View
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Comment $comment
     *
     * @return \Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', ['comment' => $comment, 'news' => $this->getNews()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'news_id' => 'bail|required|integer|exists:news,id',
            'name' => 'bail|required|string',
            'comment' => 'bail|required|string',
        ]);

        $comment->update($request->all());

        return redirect('admin/comments')->with('flash_message', 'Comment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect('admin/comments')->with('flash_message', 'Comment deleted!');
    }

    private function getNews(): Collection
    {
        return News::query()->pluck('name', 'id');
    }
}
