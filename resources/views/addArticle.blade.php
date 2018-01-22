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

                <div class="breadcrumb">
                    <a href="{{url("/")}}">← @lang('pagination.overview')</a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        @lang('article.addArticle')
                    </div>

                    <div class="panel-body">
                        <form action="{{url('article/add')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Article data -->
                            <div class="form-group">
                                <label for="article-title" class="col-sm-3 control-label">@lang('article.title')</label>

                                <div class="col-sm-6">
                                    <input type="text" name="title" id="article-title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="article-url" class="col-sm-3 control-label">@lang('article.url')</label>

                                <div class="col-sm-6">
                                    <input type="text" name="url" id="article-url" class="form-control">
                                </div>
                            </div>

                            <!-- Add Article Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> @lang('article.addArticle')
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
