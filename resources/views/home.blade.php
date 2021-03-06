@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if (session('success'))
                    <div class="bg-success">
                        {{session('success')}}
                    </div>
                    <?php session()->forget('success'); ?>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">@lang('article.overview')</div>

                    <div class="panel-body">
                        <ul class="article-overview">
                            @foreach($posts as $post)
                                <li>
                                    <div class="vote">
                                        @if(Auth::guest())
                                            <div class="form-inline upvote">
                                                <i class="fa fa-btn fa-caret-up disabled upvote" title="@lang('article.upVoteLogin')"></i>
                                            </div>
                                        @elseif ($post->user_id === Auth::id())
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

                                            @if(Auth::guest())
                                                <div class="form-inline downvote">
                                                    <i class="fa fa-btn fa-caret-down disabled downvote" title="@lang('article.downVoteLogin')"></i>
                                                </div>
                                            @elseif ($post->user_id === Auth::id())
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
                                        {{$post->total}}
                                        @if($post->total === '1' || $post->total === '-1')
                                            point
                                            @else
                                            points
                                        @endif
                                        | @lang('article.poster')
                                        {{$poster = call_user_func('\App\Http\Controllers\PostController::articlePoster', $post->user_id)}}
                                        |
                                        <a href="{{url("/comments/$post->id")}}">
                                            {{call_user_func('\App\Http\Controllers\PostController::countComments', $post->id)}}
                                        </a>
                                        @if( isset(Auth::user()->name) && $poster === Auth::user()->name)
                                            <a href="{{url("/article/edit/$post->id")}}" class="btn btn-primary btn-xs edit-btn">@lang('article.edit')</a>
                                        @endif
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
