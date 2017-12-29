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

                <div class="breadcrumb">
                    <a href="{{url('/')}}">← back to overview</a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Article: {{$post->name}}</div>

                    <div class="panel-body">
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
                            {{call_user_func('\App\Http\Controllers\PostController::countVotes', $post->id)}}
                            | posted by
                            {{call_user_func('\App\Http\Controllers\PostController::articlePoster', $post->user_id)}}
                            |
                            {{call_user_func('\App\Http\Controllers\PostController::countComments', $post->user_id)}}
                        </div>
                        <div class="comments">
                            <ul>
                                @foreach($comments as $comment)
                                    <li>
                                        <div class="comment-body">{{$comment->content}}</div>
                                        <div class="comment-info">
                                            Posted by {{$poster = call_user_func('\App\Http\Controllers\PostController::articlePoster', $comment->user_id)}}
                                            on {{$comment->created_at}}
                                            @if($poster === Auth::user()->name)
                                                <a href="{{url("comments/edit/$comment->id")}}" class="btn btn-primary btn-xs edit-btn">edit</a>

                                                <a href="{{url("comments/delete/$comment->id")}}" class="btn btn-danger btn-xs edit-btn">
                                                    <i class="fa fa-btn fa-trash" title="delete"></i> delete
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            @guest
                                <p>You need to be <a href="{{url('/login')}}">logged in</a> to comment</p>
                            @else
                                <form action="{{url('comments/add')}}" method="POST" class="form-horizontal">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <!-- Comment data -->
                                    <div class="form-group">
                                        <label for="body" class="col-sm-3 control-label">Comment</label>

                                        <div class="col-sm-6">
                                            <textarea name="body" id="body" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="article_id" value="{{$post->id}}">

                                    <!-- Add comment -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-plus"></i> Add comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
