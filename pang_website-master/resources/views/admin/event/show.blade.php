@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">活动详细资料</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal">
                        {{-- <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.user.store') }}"> --}}
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">活动名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('event_name') ? ' is-invalid' : '' }}"
                                        id="title" name="title"
                                        value="{{ old('event_name') ? old('event_name') : $event->event_name }}"
                                        placeholder="工作名称" required disabled />
                                    @if ($errors->has('event_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('event_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="event_content"
                                    class="col-sm-3 text-end control-label col-form-label">活动内容</label>
                                <div class="col-sm-9">
                                    <textarea id="summernote" class="summernote" name="event_content"></textarea>
                                    <input type="hidden" id="hiddenFieldForDesc" value="{{ $event->event_content }}">
                                    @if ($errors->has('event_content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('event_content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">活动照片</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        {{-- <img src=" {{ asset('image/event/' . $event->event_title_image_path) }}" height="130"
                                            width="130" style="border:solid"> --}}
                                        @foreach ($imageArr as $imgFile)
                                            <img src=" {{ asset($imgFile) }}" height="130" width="130"
                                                style="border:solid">
                                        @endforeach
                                    </div>
                                    @if ($errors->has('event_title_image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('event_title_image_path') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="video" class="col-sm-3 text-end control-label col-form-label">活动视频</label>
                                <div class="col-sm-9">
                                    <div class="w-auto d-flex flex-wrap justify-content-start m-2">
                                        @foreach ($videoArr as $video)
                                            <video class="embed-responsive-item  video-blog" width="400" height="300"
                                                src="{{ asset($video) }}" title="URL video player" allowfullscreen=""
                                                controls="0" sandbox="" frameborder="0" scrolling="no"></video>
                                        @endforeach
                                        {{-- <video id="myVideo" width="400" height="300">
                                            <source
                                                src="{{ asset('assets/videos/event/' . $event->media_path)}}"
                                                type="video/mp4"> --}}
                                        {{-- <video class="embed-responsive-item  video-blog" width="400" height="300"
                                                src="{{ asset('assets/videos/event/' . $event->media_path)}}"
                                                title="URL video player" allowfullscreen="" controls="0" 
                                                sandbox="" frameborder="0" scrolling="no"></video> --}}
                                        {{--
                                        </video> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">状态</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="is_publish" name="is_publish" disabled>
                                        @if ($event->is_publish)
                                            <option>
                                                已发布
                                            </option>
                                        @else
                                            <option>
                                                未发布
                                            </option>
                                        @endif
                                    </select>
                                    @if ($errors->has('is_publish'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('is_publish') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" disabled>
                                    提交
                                </button>
                                <a href="{{ route('admin.event.index') }}" class="btn btn-primary"
                                    id="back">{{ __('返回') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptfile')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-zh-CN.min.js"></script> //Translate summernote toolbar to chinise
@endsection


@section('js')
    <script>
        var SummernoteDemo = {
            init: function() {
                $(".summernote").summernote({
                    // placeholder: '内容在此输入......',
                    height: 500,
                    spellCheck: true,
                    codeviewFilter: false,
                    codeviewIframeFilter: true,
                    lang: 'zh-CN',

                })
            }
        };

        jQuery(document).ready(function() {
            SummernoteDemo.init();
            var markupStr = $("#hiddenFieldForDesc").val();
            $('#summernote').summernote('code', markupStr);
            $('#summernote').summernote('disable');
            $('.note-editable').find('a').on('click', function(e) {
                e.preventDefault();
            });
            $('.note-editable').find('a').css('color', 'grey');
        });
    </script>
@endsection
