@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create your Post</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="text-center">{{ $post->title }}</div>
                            <div class="text-center">{{ $post->body }}</div>
                            <video width="320" height="240" controls>
                                <source src="/uploads/{{ $post->video }}" type="video/webm">
                                <source src="/uploads/{{ $post->video }}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="row">
                            @foreach ($comments as $comment)
                                <p>{{ $comment['value'] }}</p>
                                <p>By: <b>{{ $comment['user'] }}</b></p>
                            @endforeach
                            <form action="{{ url('/comment') }}" method="POST" class="col-md-12">
                                {{ csrf_field() }}
                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                <div class="form-group">
                                    <textarea name="comment"
                                              id="comment"
                                              cols="30"
                                              rows="10"
                                              placeholder="Place your comment here..."
                                              class="form-control"
                                              maxlength="255">
                                    </textarea>
                                </div>
                                <input type="Submit" value="Submit" class="btn btn-primary">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
