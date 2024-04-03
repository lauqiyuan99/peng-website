@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">更改通告资料</h4>
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
                        action="{{ route('admin.notice.update', $notice->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="notice_name" class="col-sm-3 text-end control-label col-form-label">通告名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('notice_name') ? ' is-invalid' : '' }}"
                                        id="notice_name" name="notice_name"
                                        value="{{ old('notice_name') ? old('notice_name') : $notice->notice_name }}"
                                        placeholder="在此输出通告名称" required />
                                    @if ($errors->has('notice_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('notice_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notice_content"
                                    class="col-sm-3 text-end control-label col-form-label">通告内容</label>
                                <div class="col-sm-9">
                                    <textarea id="summernote" class="summernote" name="notice_content"></textarea>
                                    <input type="hidden" id="hiddenFieldForDesc" value="{{ $notice->notice_content }}">
                                    @if ($errors->has('notice_content'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('notice_content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <x-img-upload labelName="通告照片" btnName="上传照片" inputName="notice_title_image_path[]"
                                screenMode="Edit" attr="notice_title_image_path" :list="$imageArr" />

                            <x-vid-upload labelName="通告视频" btnName="上传视频" inputName="media_path[]" screenMode="Edit"
                                attr="media_path" :list="$videoArr" />
                        </div>
                        <div class="form-group row">
                            <label for="is_publish" class="col-sm-3 text-end control-label col-form-label">状态</label>
                            <div class="col-sm-2">
                                <select class="form-select" aria-label="" id="is_publish" name="is_publish">
                                    <option @if (old('is_publish', $notice->is_publish) == 1) selected @endif value=1>
                                        已发布
                                    </option>
                                    <option @if (old('is_publish', $notice->is_publish) == 0) selected @endif value=0>
                                        不发布
                                    </option>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">
                            提交
                        </button>
                        <a href="{{ route('admin.notice.index') }}" class="btn btn-primary"
                            id="back">{{ __('返回') }}</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptfile')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-zh-CN.min.js"></script>
    {{-- <script type="text/javascript" src="{{ URL::asset('js/videoEdit.js') }}" defer></script> --}}
    {{-- <script type="text/javascript" src="{{ URL::asset('js/mutipleImageHandle.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('js/mutipleVideoHandle.js') }}" defer></script> --}}
    //Translate summernote toolbar to chinise
@endsection

@section('js')
    <script>
        // Image Preview Usage
        // notice_title_image_path.onchange = evt => {
        //     var ext = $('#notice_title_image_path').val().split('.').pop().toLowerCase();
        //     if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //         alert('只有照片是被允许的');
        //         $('#notice_title_image_path').attr('src', "");
        //         //   $('#notice_title_image_path').removeAttr('src');
        //         $(":submit").attr('disabled', true);
        //         return;
        //     }
        //     const [file] = notice_title_image_path.files
        //     if (file) {
        //         display.src = URL.createObjectURL(file)
        //     }
        //     $(":submit").attr('disabled', false);
        // }

        // $(document).on("change", "#media_path", function(evt) { // Video Preview
        //     var ext = $('#media_path').val().split('.').pop().toLowerCase();
        //     if ($.inArray(ext, ['mp4', 'mpg', 'mpeg', 'avi', 'wmv', 'mov', 'rm', 'ram', 'swf', 'flv', 'ogg',
        //             'webm'
        //         ]) == -1) {
        //         if (document.getElementById('media_path').files.length != 0) {
        //             $('input#media_path').attr('type', '');
        //             $('input#media_path').attr('type', 'file');
        //             // $("source").attr('src','mov_bbb.mp4');
        //             alert('只有视频是被允许的');
        //             $('#delete_video_btn').prop('disabled', true);
        //             return;
        //         }
        //     }
        //     var $source = $('#video_here');
        //     $source[0].src = URL.createObjectURL(this.files[0]);
        //     $source.parent()[0].load();
        //     $('#delete_video_btn').prop('disabled', false);
        // });

        // $('#delete_video_btn').click(function(e) {
        //     e.preventDefault();
        //     var videoElement = document.getElementById('video');
        //     var source = document.getElementById('video_here');
        //     var text = '确定删除此视频？删除后视频将无法被恢复'
        //     if (!document.getElementById('media_path').files.length == 0 || source.src) {
        //         if (confirm(text)) {
        //             $('input#media_path').attr('type', '');
        //             $('input#media_path').attr('type', 'file');
        //             videoElement.pause();
        //             source.setAttribute('src', '');
        //             videoElement.load();
        //             $('#isDeletePreviousVideoHiddenField').val(true);
        //             $('#delete_video_btn').prop('disabled', true);
        //         }
        //     }
        // });

        // $('#media_path').click(function(e) {
        //     $('#isDeletePreviousVideoHiddenField').val(false);
        // });

        var SummernoteDemo = {
            init: function() {
                $(".summernote").summernote({
                    placeholder: '注意事项在此输入......',
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

        });
    </script>
@endsection
