@extends("layouts.share")
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">页面详细资料</h4>
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
                                <label for="title" class="col-sm-3 text-end control-label col-form-label">标题</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                                        name="title" value="{{ old('title') ? old('title') : $page->title }}"
                                        placeholder="标题" required disabled />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">网址</label>
                                <div class="col-sm-9">
                                    <textarea type="text"
                                        class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" id="url"
                                        name="url" value="{{ old('url') ? old('url') : $page->url }}" placeholder="网址"
                                        required disabled
                                        style="max-height:300px">{{ old('url') ? old('url') : $page->url }}</textarea>
                                    @if ($errors->has('url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ranking" class="col-sm-3 text-end control-label col-form-label">排行</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('ranking') ? ' is-invalid' : '' }}"
                                        id="ranking" name="ranking"
                                        value="{{ old('ranking') ? old('ranking') : $page->ranking }}"
                                        placeholder="Ranking" required disabled />
                                    @if ($errors->has('ranking'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ranking') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-end control-label col-form-label">内容</label>
                                <div class="col-sm-9">
                                    <textarea id="summernote" class="summernote" name="description"></textarea>
                                    <input type="hidden" id="hiddenFieldForDesc" value="{{ $page->description }}">

                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" disabled>
                                    提交
                                </button>
                                <a href="{{ route('admin.page.index') }}" class="btn btn-primary"
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
                    placeholder: '内容在此输入......',
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
