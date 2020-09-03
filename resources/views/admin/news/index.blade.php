@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">News</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/news/create') }}" class="btn btn-success btn-sm" title="Add New news">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET"
                              action="{{ url('/admin/news') }}"
                              accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right"
                              role="search">
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       placeholder="Search..."
                                       value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>Picture</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            <img src="{{ Storage::disk('public')->url(config('news.public_path') . $item->picture) }}" width="64" alt="{{ $item->name }}">
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/news/' . $item->id) }}" title="View news">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i></button>
                                            </a>
                                            <a href="{{ url('/admin/news/' . $item->id . '/edit') }}" title="Edit news">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                  action="{{ url('/admin/news' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8"
                                                  style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Delete news"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $news->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
