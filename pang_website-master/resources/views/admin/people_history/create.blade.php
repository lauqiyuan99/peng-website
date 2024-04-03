@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">添加事迹</h4>
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
                    <x-form-validation :errorlist="$errors"/>
                    {{-- <form class="form-horizontal"> --}}
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.people_history.store') }}">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="history_name"
                                    class="col-sm-3 text-end control-label col-form-label">事件名称</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                        class="form-control{{ $errors->has('history_name') ? ' is-invalid' : '' }}"
                                        id="history_name" name="history_name" value="{{ old('history_name') }}"
                                        placeholder="在此输出事件名称"  />                                 
                                </div>
                            </div>

                            <x-img-upload labelName="事件照片" btnName="上传照片" inputName="image_path[]" screenMode="Add"
                                attr="image_path" list="" />

                            <div class="form-group row">
                                <label for="incident_date"
                                    class="col-sm-3 text-end control-label col-form-label">发生于</label>
                                <div class="col-sm-2">
                                    <input type="date"
                                        class="form-control{{ $errors->has('incident_date') ? ' is-invalid' : '' }}"
                                        id="incident_date" name="incident_date" value="{{ old('incident_date') }}"
                                        placeholder="发生于" max="9999-12-31" />                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">事件内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description"
                                        name="description" value="{{ old('description') }}" placeholder="事件内容" style="max-height:300px" rows="4"
                                        cols="50"></textarea>                                  
                                </div>
                            </div>
                            <x-vid-upload labelName="事件视频" btnName="上传视频" inputName="media_path[]" screenMode="Add"
                                attr="media_path" list="" />

                            <x-data-input-list labelFor="people_id" labelName="事件人物" :lists="$pplNameArr"
                                attr="incident_person" selected=""/>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">
                                    提交
                                </button>
                                <a href="{{ route('admin.people_history.index') }}" class="btn btn-primary"
                                    id="back">{{ __('返回') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scriptfile')
        {{-- <script type="text/javascript" src="{{ URL::asset('js/videoCreate.js') }}" defer></script> --}}
        {{-- <script type="text/javascript" src="{{ URL::asset('js/mutipleImageHandle.js') }}" defer></script>
        <script type="text/javascript" src="{{ URL::asset('js/mutipleVideoHandle.js') }}" defer></script> --}}
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
            //             $("source").attr('src', '{{ URL::asset('/image/people_history/noimage.jpg') }}');
            //             alert('只有照片是被允许的');
            //             return;
            //         }
            //     }
            //     const [file] = image_path.files
            //     if (file) {
            //         display.src = URL.createObjectURL(file)
            //     }
            // }

            // incident_date.onclick = evt => {
            //         var today = new Date();
            //         var dd = String(today.getDate()).padStart(2, '0');
            //         var mm = String(today.getMonth() + 1).padStart(2, '0');
            //         var yyyy = today.getFullYear();

            //         today = yyyy + '-' + mm + '-' + dd;
            //         $('#incident_date').attr('min',today);
            // }   
        </script>
    @endsection
