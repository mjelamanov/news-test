@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">news {{ $news->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/news') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/news/' . $news->id . '/edit') }}" title="Edit news">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST"
                              action="{{ url('admin/news' . '/' . $news->id) }}"
                              accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    title="Delete news"
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
                                    <td>{{ $news->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $news->name }} </td>
                                </tr>
                                <tr>
                                    <th> Content</th>
                                    <td> {{ $news->content }} </td>
                                </tr>
                                <tr>
                                    <th> Picture</th>
                                    <td>
                                        <img src="{{ Storage::disk('public')->url(config('news.public_path') . $news->picture) }}" width="128" alt="{{ $news->name }}">
                                    </td>
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
