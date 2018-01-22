@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="breadcrumb">
                    <a href="{{url("comments/$comment->post_id")}}">← @lang('pagination.overview')</a>
                </div>

                @if (session('success'))
                    <div class="bg-success">
                        {{ session('success') }}
                    </div>
                    <?php session()->forget('success'); ?>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        @lang('article.editComment')
                        <a href="{{url("comments/delete/$comment->id")}}" class="btn btn-danger btn-xs edit-btn pull-right">
                            <i class="fa fa-btn fa-trash" title="delete"></i> @lang('article.delete')
                        </a>
                    </div>

                    <div class="panel-body">
                        <form action="{{url('comments/edit')}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Article data -->
                            <div class="form-group">
                                <label for="body" class="col-sm-3 control-label">@lang('article.editComment')</label>

                                <div class="col-sm-6">
                                    <textarea name="body" id="body" class="form-control">{{$comment->content}}</textarea>
                                </div>
                            </div>

                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                            <!-- Add Article Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-pencil-square-o"></i> @lang('article.editComment')
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
