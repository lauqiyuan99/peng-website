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
                        action="{{ route('admin.theme.update', $themes->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="key" class="col-sm-3 text-end control-label col-form-label">主要设置</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                                        id="key" name="key" value="{{ old('key') ? old('key') : $themes->key }}" required
                                        disabled />
                                    @if ($errors->has('key'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('key') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="value" class="col-sm-3 text-end control-label col-form-label">设置内容</label>
                                @if (($themes->id >= 1 && $themes->id <= 3) || ($themes->id >= 6 && $themes->id <= 11))
                                    <div class="col-sm-9">
                                        <input type="text" id="value" name="value"
                                            value="{{ old('value') ? old('value') : $themes->value }}"
                                            class="form-control color{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                            data-control="hue" />

                                        @if ($errors->has('value'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('value') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if ($themes->id == 4)
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                                id="value" name="value" onchange="show(this)" />
                                            <br />
                                            <br />
                                            <img src="{{ asset(file_exists($themes->value) ? $themes->value : 'assets/images/MainPageBanner.png') }}" height="130" width="350" style="border:solid" id="display">
                                        </div>
                                        @if ($errors->has('value'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('value') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if ($themes->id == 5)
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                                id="value" name="value" onchange="show(this)" />
                                            <br />
                                            <br />
                                            <img src="{{ asset(file_exists($themes->value) ? $themes->value : 'assets/images/MainPageBackground.png') }}" height="130" width="130" style="border:solid" id="display">
                                        </div>
                                        @if ($errors->has('value'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('value') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">
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

        function show(input) {
            debugger;
            var validExtensions = ['jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG']; //array of valid extensions
            var fileName = input.files[0].name;
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            var maxSize = 3145728; //3mb
            if ($.inArray(fileNameExt, validExtensions) == -1) {
                input.type = ''
                input.type = 'file'
                $('#value').attr('src', "");
                // https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg
                $('#display').attr('src', '{{ URL::asset('/image/avatar/noimage.jpg') }}');
                alert("Only these file types are accepted : " + validExtensions.join(', '));
            } else {
                if (input.files && input.files[0] && input.files.size < maxSize || input.files[0].size < maxSize) {
                    var filerdr = new FileReader();
                    filerdr.onload = function(e) {
                        $('#display').attr('src', e.target.result);
                    }
                    filerdr.readAsDataURL(input.files[0]);
                } else {
                    input.type = ''
                    input.type = 'file'
                    $('#value').attr('src', "");
                    $('#display').attr('src', '{{ URL::asset('/image/avatar/noimage.jpg') }}');
                    alert("Maximum file size is 3MB.");
                }
            }
        }
    </script>
@endsection
