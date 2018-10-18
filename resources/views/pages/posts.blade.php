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
                        @foreach ($posts as $post)
                            <a href="{{ url('posts/' . $post->id) }}" class="col-md-6">
                                <div class="text-center">{{ $post->title }}</div>
                                <img src="/uploads/{{ $post->video }}" alt="" class="img-responsive">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
