@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <a href="{{ route('') }}" class="list-group-item">我的主页</a>
                    <a href="{{ route('') }}" class="list-group-item">我的回答</a>
                    <a href="{{ route('') }}" class="list-group-item">我的提问</a>
                    <a href="{{ route('') }}" class="list-group-item">我的天梯分</a>
                    <a href="{{ route('') }}" class="list-group-item">我的经验</a>
                    <a href="{{ route('') }}" class="list-group-item">我的粉丝</a>
                    <a href="{{ route('') }}" class="list-group-item">我的关注</a>
                    <a href="{{ route('') }}" class="list-group-item">我的收藏</a>
                </ul>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        您已登录!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
