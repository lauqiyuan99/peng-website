@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">更改商业资料</h4>
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
                        action="{{ route('admin.business.update', $business->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">商业名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                        name="name" value="{{ old('name') ? old('name') : $business->name }}"
                                        placeholder="在此输出商业名称" required />
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
                                                {{ $business->category == $key ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <x-img-upload labelName="商业照片" btnName="上传照片" inputName="image_path[]" screenMode="Edit"
                                :list="$imageArr" attr="image_path"/>

                            <div class="form-group row">
                                <label for="status" class="col-sm-3 text-end control-label col-form-label">状态</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="status" name="status">
                                        <option @if (old('status', $business->status) == 1) selected @endif value=1>
                                            已发布
                                        </option>
                                        <option @if (old('status', $business->status) == 2) selected @endif value=2>
                                            未发布
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">商业内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description"
                                        name="description" placeholder="商业内容" style="max-height:300px" rows="4" cols="50">{{ old('description') ? old('description') : $business->description }}</textarea>
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
                                        name="background" placeholder="商业背景" style="max-height:300px" rows="4" cols="50">{{ old('background') ? old('background') : $business->background }}</textarea>
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
                                        name="address" placeholder="商业地址" style="max-height:300px" rows="4" cols="50">{{ old('address') ? old('address') : $business->address }}</textarea>

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

        //Translate summernote toolbar to chinise
    @endsection

    {{-- @section('js')
    <script>
        // Image Preview Usage
        image_path.onchange = evt => {
            var ext = $('#image_path').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert('只有照片是被允许的');
                $('#image_path').attr('src', "");
                //   $('#image_path').removeAttr('src');
                $(":submit").attr('disabled', true);
                return;
            }
            const [file] = image_path.files
            if (file) {
                display.src = URL.createObjectURL(file)
            }
            $(":submit").attr('disabled', false);
        }

        posted_on.onclick = evt => {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#posted_on').attr('min', today);
        }

        var SummernoteDemo = {
            init: function() {
                $(".summernote").summernote({
                    placeholder: '注意事项在此输入......',
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
            var markupStr = $("#hiddenFieldForDesc").val();
            $('#summernote').summernote('code', markupStr);
            $("#salary").inputmask('Regex', {
                regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"
            }); // Salary Field only allow enter numeric

        });
    </script>
    @endsection  --}}
