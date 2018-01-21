@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Whoops! Something went wrong!</strong>
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
                        Are you sure you want to delete this article?

                        <form action="{{url("article/delete")}}" method="POST" class="pull-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <button name="delete" class="btn btn-danger" value="{{$article->id}}">
                                <i class="fa fa-btn fa-trash" title="delete"></i> confirm delete
                            </button>

                            <button name="cancel" class="btn" value="{{$article->id}}">
                                <i class="fa fa-btn fa-trash" title="delete"></i> cancel
                            </button>

                        </form>
                    </div>
                @endif

                <div class="breadcrumb">
                    <a href="{{url("/")}}">← back to overview</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Edit article
                            <a href="{{url("article/delete/$article->id")}}" class="btn btn-danger btn-xs pull-right">
                            <i class="fa fa-btn fa-trash" title="delete"></i> delete article
                        </a>
                    </div>

                    <div class="panel-body">
                        <form action="{{url('article/edit')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Article data -->
                            <div class="form-group">
                                <label for="article-title" class="col-sm-3 control-label">Title (max. 255 characters)</label>

                                <div class="col-sm-6">
                                    <input type="text" name="title" id="article-title" class="form-control" value="{{$article->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="article-url" class="col-sm-3 control-label">URL</label>

                                <div class="col-sm-6">
                                    <input type="text" name="url" id="article-url" class="form-control" value="{{$article->url}}">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$article->id}}">

                            <!-- Add Article Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-pencil-square-o"></i> Edit Article
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
