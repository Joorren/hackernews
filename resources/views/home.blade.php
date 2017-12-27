@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Article Overview</div>

                    <div class="panel-body">
                        <ul class="article-overview">
                            @foreach($posts as $post)
                                <li>
                                    <div class="vote">
                                        <form action="{{url('/vote/up')}}" method="POST" class="form-inline upvote">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button name="article_id" value="{{$post->id}}">
                                                <i class="fa fa-btn fa-caret-up" title="upvote"></i>
                                            </button>
                                        </form>
                                        <form action="{{url('/vote/down')}}" method="POST" class="form-inline downvote">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button name="article_id" value="{{$post->id}}">
                                                <i class="fa fa-btn fa-caret-down" title="downvote"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="url">
                                        <a href="{{$post->url}}" class="urlTitle">{{$post->name}}</a>
                                    </div>
                                    <div class="info">
                                        {{call_user_func('\App\Http\Controllers\PostController::countVotes', $post->id)}}  | posted by {{call_user_func('\App\Http\Controllers\PostController::articlePoster', $post->user_id)}} | <a href="#">1 comment</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
