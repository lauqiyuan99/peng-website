@extends('layouts.share')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">详细资料</h4>
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
                    <form class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="key" class="col-sm-3 text-end control-label col-form-label">主要设置</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                                        id="key" name="key" value="{{ old('key') ? old('key') : $themes->key }}" required
                                        disabled />
                                    @if ($errors->has('key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('key') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="value" class="col-sm-3 text-end control-label col-form-label">设置内容</label>
                                @if ($themes->id == 1 || $themes->id == 2 || $themes->id == 3)
                                    <div class="col-sm-9">
                                        <input type="text" id="value" name="value"
                                            value="{{ old('value') ? old('value') : $themes->value }}"
                                            class="form-control color{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                            data-control="hue" required disabled />

                                        @if ($errors->has('value'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('value') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if ($themes->id == 4)
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <img src=" {{ asset($themes->value) }}" height="130" width="350"
                                                style="border:solid">
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if ($themes->id == 5)
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <img src=" {{ asset($themes->value) }}" height="130" width="130"
                                                style="border:solid">
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if ($themes->id == 6 || $themes->id == 7 || $themes->id == 8)
                                    <div class="col-md-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                            id="value" name="value"
                                            value="{{ old('value') ? old('value') : $themes->value }}" required
                                            disabled />
                                        @if ($errors->has('value'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('value') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" disabled>
                                    提交
                                </button>
                                <a href="{{ route('admin.theme.index') }}" class="btn btn-primary"
                                    id="back">{{ __('返回') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('js')
    <script>
        /*colorpicker*/
        $(".color").each(function() {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr("data-control") || "hue",
                position: $(this).attr("data-position") || "bottom left",

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ", " + opacity;
                    if (typeof console === "object") {
                        console.log(value);
                    }
                },
                theme: "bootstrap",
            });
        });
    </script>
@endsection
