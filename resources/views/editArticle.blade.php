@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>@lang('errors.failed')</strong>
                        <br>
                        <br>
                        <ul>
                            @foreach(session('error') as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <?php session()->forget('error'); ?>
                @endif

                @if ($confirm)
                    <div class="bg-danger clearfix">
                        @lang('article.deleteConfirmText')

                        <form action="{{url("article/delete")}}" method="POST" class="pull-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <button name="delete" class="btn btn-danger" value="{{$article->id}}">
                                <i class="fa fa-btn fa-trash" title="delete"></i> @lang('article.deleteConfirm')
                            </button>

                            <button name="cancel" class="btn" value="{{$article->id}}">
                                <i class="fa fa-btn fa-trash" title="delete"></i> @lang('article.cancel')
                            </button>

                        </form>
                    </div>
                @endif

                <div class="breadcrumb">
                    <a href="{{url("/")}}">← @lang('pagination.overview')</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        @lang('article.editArticle')
                            <a href="{{url("article/delete/$article->id")}}" class="btn btn-danger btn-xs pull-right">
                            <i class="fa fa-btn fa-trash" title="delete"></i> @lang('article.deleteArticle')
                        </a>
                    </div>

                    <div class="panel-body">
                        <form action="{{url('article/edit')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Article data -->
                            <div class="form-group">
                                <label for="article-title" class="col-sm-3 control-label">@lang('article.title')</label>

                                <div class="col-sm-6">
                                    <input type="text" name="title" id="article-title" class="form-control" value="{{$article->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="article-url" class="col-sm-3 control-label">@lang('article.url')</label>

                                <div class="col-sm-6">
                                    <input type="text" name="url" id="article-url" class="form-control" value="{{$article->url}}">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$article->id}}">

                            <!-- Add Article Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-pencil-square-o"></i> @lang('article.editArticle')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
