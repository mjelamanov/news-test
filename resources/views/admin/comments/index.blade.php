@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Comments</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/comments/create') }}"
                           class="btn btn-success btn-sm"
                           title="Add New comment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET"
                              action="{{ url('/admin/comments') }}"
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
                                    <th>News</th>
                                    <th>Name</th>
                                    <th>Comment</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>
                                            <a href="{{ route('news.show', $item->news_id) }}">{{ $item->news->name }}</a>
                                        </td>
                                        <td>{{ $item->name ?: $item->user->name }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>
                                            <a href="{{ url('/admin/comments/' . $item->id) }}" title="View comment">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i></button>
                                            </a>
                                            <a href="{{ url('/admin/comments/' . $item->id . '/edit') }}"
                                               title="Edit comment">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                  action="{{ url('/admin/comments' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8"
                                                  style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Delete comment"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comments->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
