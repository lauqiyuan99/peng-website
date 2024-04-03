@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">工作详细资料</h4>
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
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">工作名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="title"
                                        name="title" value="{{ old('name') ? old('name') : $job->name }}"
                                        placeholder="工作名称" required disabled />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">工作种类</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="category" name="category" disabled>
                                        <option value="{{ $jobCatName }}">
                                            {{ $jobCatName }}
                                        </option>
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">薪水</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" id="salary"
                                        titlle="salary" value="{{ old('salary') ? old('salary') : $job->salary }}"
                                        placeholder="" required disabled />
                                    @if ($errors->has('salary'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('salary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">工作照片</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
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
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">发布于</label>
                                <div class="col-sm-2">
                                    <input type="date"
                                        class="form-control{{ $errors->has('posted_on') ? ' is-invalid' : '' }}"
                                        id="posted_on" title="posted_on"
                                        value="{{ old('posted_on') ? old('posted_on') : $job->posted_on }}"
                                        placeholder="发布于" required disabled />
                                    @if ($errors->has('posted_on'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('posted_on') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">状态</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="status" name="status" disabled>
                                        @if ($job->status == 1)
                                            <option>
                                                已发布
                                            </option>
                                        @else
                                            <option>
                                                未发布
                                            </option>
                                        @endif
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">工作内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description"
                                        name="description" required style="max-height:300px" rows="4" cols="50" disabled>{{ old('description') ? old('description') : $job->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">注意事项</label>
                                <div class="col-sm-9">
                                    <textarea id="summernote" class="summernote" name="note"></textarea>
                                    <input type="hidden" id="hiddenFieldForDesc" value="{{ $job->note }}">
                                    @if ($errors->has('note'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">公司背景</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('background') ? ' is-invalid' : '' }}" id="background"
                                        name="background" required style="max-height:300px" rows="4" cols="50" disabled>{{ old('background') ? old('background') : $job->background }}</textarea>
                                    @if ($errors->has('background'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('background') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">公司地址</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address"
                                        name="address" required style="max-height:300px" rows="4" cols="50" disabled>{{ old('address') ? old('address') : $job->address }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="business" class="col-sm-3 text-end control-label col-form-label">生意</label>
                                <div class="col-sm-2">
                                    <select class="form-select" aria-label="" id="business" disabled name="business">
                                        @if ($currentBusiness)
                                            <option value="{{ $currentBusiness->id }}">{{ $currentBusiness->name }}
                                            </option>
                                        @endif
                                    </select>
                                    @if ($errors->has('business'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('business') }}</strong>
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
                                <a href="{{ route('admin.job.index') }}" class="btn btn-primary"
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
            $('#summernote').summernote('disable');
            $('.note-editable').find('a').on('click', function(e) {
                e.preventDefault();
            });
            $('.note-editable').find('a').css('color', 'grey');
        });
    </script>
@endsection
