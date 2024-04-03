@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">添加活动</h4>
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
                    {{-- <form class="form-horizontal"> --}}
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.event.store') }}">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="event_name" class="col-sm-3 text-end control-label col-form-label">活动名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('event_name') ? ' is-invalid' : '' }}"
                                        id="event_name" name="event_name" value="{{ old('event_name') }}"
                                        placeholder="在此输出活动名称" required />
                                    @if ($errors->has('event_name'))
                                        <span class="text-danger" role="alert">
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
                                    @if ($errors->has('event_content'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('event_content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <x-img-upload labelName="活动照片" btnName="上传照片" inputName="event_title_image_path[]" screenMode="Add" attr="event_title_image_path" list="" />


                            <x-vid-upload labelName="活动视频" btnName="上传视频" inputName="media_path[]" screenMode="Add" attr="media_path" list="" />

                            <div class="form-group row">
                                <label for="is_publish" class="col-sm-3 text-end control-label col-form-label">状态</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="is_publish" name="is_publish">
                                        <option value="" selected>---未选择---</option>
                                        <option value=1 @if (old('is_publish') == 1)  @endif>发布</option>
                                        <option value=0 @if (old('is_publish') == 0)  @endif>不发布</option>
                                    </select>
                                </div>
                                @if ($errors->has('is_publish'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('is_publish') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">
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
@endsection

@section('scriptfile')
    {{-- <script type="text/javascript" src="{{ URL::asset('js/deleteVideo.js') }}"></script> --}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-zh-CN.min.js"></script> //Translate summernote toolbar to chinise
    {{-- <script type="text/javascript" src="{{ URL::asset('js/videoCreate.js') }}" defer></script> --}}
   {{-- <script type="text/javascript" src="{{ URL::asset('js/mutipleImageHandle.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('js/mutipleVideoHandle.js') }}" defer></script> --}}
@endsection 

@section('js')
    <script>
        // // Image Preview Usage
        // event_title_image_path.onchange = evt => {
        //     var ext = $('#event_title_image_path').val().split('.').pop().toLowerCase();
        //     if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //         if (document.getElementById('event_title_image_path').files.length != 0) {
        //             $('input#event_title_image_path').attr('type', '');
        //             $('input#event_title_image_path').attr('type', 'file');
        //             $("#display").attr('src', '{{ URL::asset('/image/avatar/noimage.jpg') }}');
        //             alert('只有照片是被允许的');
        //             return;
        //         }
        //     }
        //     const [file] = event_title_image_path.files
        //     if (file) {
        //         display.src = URL.createObjectURL(file)
        //     }
        // }

        // $(document).on("change", "#media_path", function(evt) { // Video Preview
        //     var ext = $('#media_path').val().split('.').pop().toLowerCase();
        //     if ($.inArray(ext, ['mp4', 'mpg', 'mpeg', 'avi', 'wmv', 'mov', 'rm', 'ram', 'swf', 'flv', 'ogg',
        //             'webm'
        //         ]) == -1) {
        //         if (document.getElementById('media_path').files.length != 0) {
        //             $('input#media_path').attr('type', '');
        //             $('input#media_path').attr('type', 'file');
        //             $("source").attr('src', 'mov_bbb.mp4');
        //             alert('只有视频是被允许的');
        //             return;
        //         }
        //     }
        //     var $source = $('#video_here');
        //     $source[0].src = URL.createObjectURL(this.files[0]);
        //     $source.parent()[0].load();
        // });
        // Init Summer 
        var SummernoteDemo = {
            init: function() {
                $(".summernote").summernote({
                    placeholder: '内容在此输入......',
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
            // var HTMLstring = '<div><table><tr><td>Description</td><td><textarea type="text" id="description"/></td></tr><tr><td>Location: </td> <td><input type="text" id="location"/></td></tr><tr><td>Start Time: </td><td><input type="text" id="startTime"/></td></tr><tr><td>End Time: </td><td><input type="text" id="endTime"/></td></tr></table></div>';
            // $('#summernote').summernote('pasteHTML', HTMLstring);
            //  $("#salary").numeric({ decimal : ".",  negative : false, scale: 3 });
        });
    </script>
@endsection
