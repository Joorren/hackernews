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

                @if (session('success'))
                    <div class="bg-success">
                        {{session('success')}}
                    </div>
                    <?php session()->forget('success'); ?>
                @endif

                <div class="breadcrumb">
                    <a href="{{url('/')}}">← @lang('pagination.overview')</a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('article.article'): {{$post->name}}</div>

                    <div class="panel-body">
                        <div class="vote">
                            @if ($post->user_id === Auth::id())
                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-up disabled upvote" title="@lang('article.upVoteOwner')"></i>
                                </div>
                            @elseif(\App\Http\Controllers\CheckVoteController::CheckVote($post->id, 1))
                                <div class="form-inline upvote">
                                    <i class="fa fa-btn fa-caret-up disabled upvote" title="@lang('article.upVoteOnce')"></i>
                                </div>
                            @else
                                <form action="{{url('/vote/up')}}" method="POST" class="form-inline upvote">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button name="article_id" value="{{$post->id}}">
                                        <i class="fa fa-btn fa-caret-up" title="@lang('article.upVote')"></i>
                                    </button>
                                </form>
                            @endif

                            @if ($post->user_id === Auth::id())
                                <div class="form-inline downvote">
                                    <i class="fa fa-btn fa-caret-down disabled downvote" title="@lang('article.downVoteOwner')"></i>
                                </div>
                            @elseif(\App\Http\Controllers\CheckVoteController::CheckVote($post->id, -1))
                                <div class="form-inline downvote">
                                    <i class="fa fa-btn fa-caret-down disabled downvote" title="@lang('article.downVoteOnce')"></i>
                                </div>
                            @else
                                <form action="{{url('/vote/down')}}" method="POST" class="form-inline downvote">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button name="article_id" value="{{$post->id}}">
                                        <i class="fa fa-btn fa-caret-down" title="@lang('article.downVote')"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="url">
                            <a href="{{$post->url}}" class="urlTitle">{{$post->name}}</a>
                        </div>
                        <div class="info">
                            {{call_user_func('\App\Http\Controllers\PostController::countVotes', $post->id)}}
                            | @lang('article.poster')
                            {{$poster=call_user_func('\App\Http\Controllers\PostController::articlePoster', $post->user_id)}}
                            |
                            {{call_user_func('\App\Http\Controllers\PostController::countComments', $post->id)}}
                            @if( isset(Auth::user()->name) && $poster === Auth::user()->name)
                                <a href="{{url("/article/edit/$post->id")}}" class="btn btn-primary btn-xs edit-btn">@lang('article.editArticle')</a>
                            @endif
                        </div>
                        <div class="comments">
                            <ul>
                                @foreach($comments as $comment)
                                    <li>
                                        <div class="comment-body">{{$comment->content}}</div>
                                        <div class="comment-info">
                                            @lang('article.poster') {{$poster = call_user_func('\App\Http\Controllers\PostController::articlePoster', $comment->user_id)}}
                                            @lang('article.postedOn') {{$comment->created_at}}
                                            @if( isset(Auth::user()->name) && $poster === Auth::user()->name)
                                                <a href="{{url("comments/edit/$comment->id")}}" class="btn btn-primary btn-xs edit-btn">@lang('article.edit')</a>

                                                <a href="{{url("comments/delete/$comment->id")}}" class="btn btn-danger btn-xs edit-btn">
                                                    <i class="fa fa-btn fa-trash" title="delete"></i> @lang('article.delete')
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            @guest
                                <p>@lang('errors.commentLogin')</p>
                            @else
                                <form action="{{url('comments/add')}}" method="POST" class="form-horizontal">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <!-- Comment data -->
                                    <div class="form-group">
                                        <label for="body" class="col-sm-3 control-label">@lang('article.addComment')</label>

                                        <div class="col-sm-6">
                                            <textarea name="body" id="body" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="article_id" value="{{$post->id}}">

                                    <!-- Add comment -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-plus"></i> @Lang('article.addComment')
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
