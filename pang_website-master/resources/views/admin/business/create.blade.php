@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">添加商业</h4>
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
                        action="{{ route('admin.business.store') }}">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">商业名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="在此输出商业名称"  />
                                    @if ($errors->has('name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 text-end control-label col-form-label">商业种类</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="category" name="category">
                                        @foreach ($businessCatList as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $selectedCode ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <x-img-upload labelName="商业照片" btnName="上传照片" inputName="image_path[]" screenMode="Add" attr="image_path" list="" />

                            <div class="form-group row">
                                <label for="status" class="col-sm-3 text-end control-label col-form-label">状态</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="status" name="status">
                                        <option value="" selected>---未选择---</option>
                                        <option value="1" @if (old('status') == 1)  @endif>发布</option>
                                        <option value="0" @if (old('status') == 0)  @endif>不发布</option>
                                    </select>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-3 text-end control-label col-form-label">商业内容</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description"
                                    name="description" value="{{ old('description') }}" placeholder="商业内容" style="max-height:300px" rows="4"
                                    cols="50"></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="background" class="col-sm-3 text-end control-label col-form-label">商业背景</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control{{ $errors->has('background') ? ' is-invalid' : '' }}" id="background"
                                    name="background" value="{{ old('background') }}" placeholder="商业背景" style="max-height:300px" rows="4"
                                    cols="50"></textarea>
                                @if ($errors->has('background'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('background') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 text-end control-label col-form-label">商业地址</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address"
                                    name="address" value="{{ old('address') }}" placeholder="商业地址" style="max-height:300px" rows="4"
                                    cols="50">
                                    </textarea>

                                @if ($errors->has('address'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" data-submit-btn class="btn btn-primary">
                            提交
                        </button>
                        <a href="{{ route('admin.business.index') }}" class="btn btn-primary"
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
    {{-- <script type="text/javascript" src="{{ URL::asset('js/mutipleImageHandle.js') }}" defer></script> --}}

    //Translate summernote toolbar to chinise
@endsection

@section('js')
    <script>
        // Image Preview Usage
        // image_path.onchange = evt => {
        //     var ext = $('#image_path').val().split('.').pop().toLowerCase();
        //     if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //         if (document.getElementById('image_path').files.length != 0) {
        //             $('input#image_path').attr('type', '');
        //             $('input#image_path').attr('type', 'file');
        //             $("#display").attr('src', '{{ URL::asset(' / image / avatar / noimage.jpg ') }}');
        //             alert('只有照片是被允许的');
        //             return;
        //         }
        //     }
        //     const [file] = image_path.files
        //     if (file) {
        //         display.src = URL.createObjectURL(file)
        //     }
        // }
        // posted_on.onclick = evt => {
        //     var today = new Date();
        //     var dd = String(today.getDate()).padStart(2, '0');
        //     var mm = String(today.getMonth() + 1).padStart(2, '0');
        //     var yyyy = today.getFullYear();

        //     today = yyyy + '-' + mm + '-' + dd;
        //     $('#posted_on').attr('min', today);
        // }

        // var SummernoteDemo = {
        //     init: function() {
        //         $(".summernote").summernote({
        //             placeholder: '内容在此输入......',
        //             height: 200,
        //             spellCheck: true,
        //             codeviewFilter: false,
        //             codeviewIframeFilter: true,
        //             lang: 'zh-CN',

        //         })
        //     }
        // };

        // jQuery(document).ready(function() {
        //     SummernoteDemo.init();
        //     $("#salary").inputmask('Regex', {
        //         regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"
        //     });
        //     //  $("#salary").numeric({ decimal : ".",  negative : false, scale: 3 });
        // }); -->
    </script>
@endsection
