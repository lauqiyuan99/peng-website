@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">彭姓渊源详细资料</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="video" class="col-sm-3 text-end control-label col-form-label">渊源视频</label>
                                <div class="col-sm-9">
                                    <div class="w-auto d-flex flex-wrap justify-content-start m-2">
                                        @foreach ($videoArr as $video)
                                            <video class="embed-responsive-item  video-blog" width="400" height="300"
                                                src="{{ asset($video) }}" title="URL video player" allowfullscreen=""
                                                controls="0" sandbox="" frameborder="0" scrolling="no"></video>
                                        @endforeach
                                        {{-- @php
                                        $media_path = $family_origin->media_path ? 'assets/videos/family_origin/'.$family_origin->media_path : ''   
                                        @endphp                                        
                                            <video class="embed-responsive-item  video-blog" width="400" height="300"
                                                src="{{ asset($media_path)}}"
                                                title="URL video player" allowfullscreen="" controls="0" 
                                                sandbox="" frameborder="0" scrolling="no"></video>                                     --}}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">渊源照片</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        {{-- @php
                                            $image_path = $family_origin->image_path == 'noimage.jpg' ? 'image/' . $family_origin->image_path : 'image/family_origin/' . $family_origin->image_path;
                                        @endphp
                                        <img src=" {{ asset($image_path)}}" height="130"
                                            width="130" style="border:solid"> --}}
                                        @foreach ($imageArr as $imgFile)
                                            <img src=" {{ asset($imgFile) }}" height="130" width="130"
                                                style="border:solid">
                                        @endforeach
                                    </div>
                                    @if ($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">渊源内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('family_origin_content') ? ' is-invalid' : '' }}"
                                        id="family_origin_content" name="family_origin_content" required style="max-height:300px" rows="4"
                                        cols="50" disabled>{{ old('family_origin_content') ? old('family_origin_content') : $family_origin->family_origin_content }}</textarea>
                                    @if ($errors->has('family_origin_content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('family_origin_content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">年份</label>
                                <div class="col-sm-2">
                                    <input type="date"
                                        class="form-control{{ $errors->has('particular_year') ? ' is-invalid' : '' }}"
                                        id="particular_year" title="particular_year"
                                        value="{{ old('particular_year') ? old('particular_year') : $family_origin->particular_year }}"
                                        placeholder="发布于" required disabled />
                                    @if ($errors->has('particular_year'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('particular_year') }}</strong>
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
                                <a href="{{ route('admin.family_origin.index') }}" class="btn btn-primary"
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
                    height: 200,
                    spellCheck: true,
                    codeviewFilter: false,
                    codeviewIframeFilter: true,
                    lang: 'zh-CN',

                })
            }
        };

        jQuery(document).ready(function() {
            SummernoteDemo.init();
        });
    </script>
@endsection
