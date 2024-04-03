@extends('layouts.share')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">更改资料</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.blog.update', $blog->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="media_type"
                                            class="col-sm-3 text-end control-label col-form-label">媒体类型</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" aria-label="" id="media_type"
                                                name="media_type" required>
                                                @if ($blog->media_type == 'Image')
                                                    <option value="">---未选择---</option>
                                                    <option value="{{ $blog->media_type }}" selected>照片</option>
                                                    <option value="Video">影片</option>
                                                @elseif ($blog->media_type == 'Video')
                                                    <option value="">---未选择---</option>
                                                    <option value="Image">照片</option>
                                                    <option value="{{ $blog->media_type }}" selected>影片</option>
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('media_type'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('media_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                <div class="form-group row">
                                    <label for="media_path" class="col-sm-3 text-end control-label col-form-label">媒体路径</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('media_path') ? ' is-invalid' : '' }}"
                                            id="media_path" name="media_path"
                                            value="{{ old('media_path') ? old('media_path') : $blog->media_path }}"
                                            placeholder="媒体路径" required />
                                        @if ($errors->has('media_path'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('media_path') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description"
                                        class="col-sm-3 text-end control-label col-form-label">说明</label>
                                    <div class="col-sm-9">
                                        <textarea type="text"
                                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                            id="description" name="description"
                                            value="{{ old('description') ? old('description') : $blog->description }}"
                                            placeholder="说明" style="max-height:300px"
                                            required>{{ old('description') ? old('description') : $blog->description }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="year"
                                        class="col-sm-3 text-end control-label col-form-label">年份</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"
                                            id="year" name="year"
                                            value="{{ old('year') ? old('year') : $blog->year }}" placeholder="年份"
                                            required />
                                        @if ($errors->has('year'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="page_id"
                                        class="col-sm-3 text-end control-label col-form-label">页面</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="" id="page_id" name="page_id">
                                            <option value="">---未选择---</option>
                                            @if ($blog->page_id)
                                                @foreach ($blogs as $blogg)
                                                    <option value="{{ $blog->page_id }}" selected>
                                                        {{ $blog->page_id }} - {{ $blogg->title }}</option>
                                                @endforeach
                                            @endif
                                            @foreach ($page_id as $page)
                                                <option value="{{ $page->id }}">{{ $page->id }} -
                                                    {{ $page->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('page_id'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('page_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="is_publish" class="col-sm-3 text-end control-label">是否发布</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" class="form-check-input" name="is_publish"
                                            id="is_publish" value="1"
                                            {{ $blog->is_publish == 1 ? ' checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">
                                    提交
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-primary"
                                    id="back">{{ __('返回') }}</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
