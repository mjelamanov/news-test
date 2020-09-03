<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
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
            $news = News::latest()->paginate($perPage);
        } else {
            $news = News::latest()->paginate($perPage);
        }

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
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
            'name' => 'bail|required|string',
            'content' => 'bail|required|string',
            'picture' => 'bail|required|image',
        ]);

        $attributes = $request->except('picture');
        $attributes['picture'] = basename($request->file('picture')->store(config('news.storage_path')));

        News::create($attributes);

        return redirect('admin/news')->with('flash_message', 'News added!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\News $news
     *
     * @return \Illuminate\View\View
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\News $news
     *
     * @return \Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\News $news
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, News $news)
    {
        $this->validate($request, [
            'name' => 'bail|required|string',
            'content' => 'bail|required|string',
            'picture' => 'nullable|image',
        ]);

        $attributes = $request->except('picture');

        if ($request->hasFile('picture')) {
            $attributes['picture'] = basename($request->file('picture')->store(config('news.storage_path')));
        }

        $news->update($attributes);

        return redirect('admin/news')->with('flash_message', 'News updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect('admin/news')->with('flash_message', 'News deleted!');
    }
}
