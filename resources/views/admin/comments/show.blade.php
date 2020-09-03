@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">comment {{ $comment->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/comments') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/comments/' . $comment->id . '/edit') }}" title="Edit comment">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST"
                              action="{{ url('admin/comments' . '/' . $comment->id) }}"
                              accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Delete comment"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $comment->id }}</td>
                                </tr>
                                <tr>
                                    <th> News</th>
                                    <td>
                                        <a href="{{ url('/admin/news/' . $comment->news_id) }}">{{ $comment->news->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $comment->name }} </td>
                                </tr>
                                <tr>
                                    <th> Comment</th>
                                    <td> {{ $comment->comment }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
