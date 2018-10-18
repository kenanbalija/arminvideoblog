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

                            <form action="{{ url('post') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Post Title: </label>
                                    <input type="text" id="title" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="body">Post Body: </label>
                                    <textarea cols="30" rows="10" id="body" name="body" placeholder="Your text here..." class="form-control" maxlength="255">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="video">Your Video</label>
                                    <input type="file" id="file" name="file">
                                </div>

                                <input type="submit" value="Submit" class="btn btn-primary form-control">
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
