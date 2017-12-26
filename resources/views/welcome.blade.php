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
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Article Overview</div>

                    <div class="panel-body">

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
