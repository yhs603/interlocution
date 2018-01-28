@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('question.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">标题</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">内容</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description"
                                              value="{{ old('description') }}" required rows="4"></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-4 control-label">标签</label>

                                <div class="col-md-6">
                                    <input id="tags" type="text" class="form-control" name="tags" required>

                                    @if ($errors->has('tags'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-4 control-label">分类</label>

                                <div class="col-md-6">
                                    <select name="category_id">
                                        <option value="0">请选择分类</option>
                                        @if($all_categories)
                                            @foreach($all_categories as $cate)
                                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <select name="experience">
                                        <option value="0">0</option>
                                        <option value="0">5</option>
                                        <option value="0">10</option>
                                        <option value="0">20</option>
                                        <option value="0">30</option>
                                        <option value="0">50</option>
                                        <option value="0">100</option>
                                    </select>经验

                                    @if ($errors->has('experience'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('experience') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        提交
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
