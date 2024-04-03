@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">更改渊源资料</h4>
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
                        action="{{ route('admin.family_origin.update', $family_origin->id) }}">
                        @csrf
                        @method('PATCH')

                      
                        <div class="card-body">
                       
   <x-vid-upload labelName="渊源视频" btnName="上传视频" inputName="media_path[]" screenMode="Edit" attr="media_path" :list="$videoArr" />                   
 <x-img-upload labelName="渊源照片" btnName="上传照片" inputName="image_path[]" screenMode="Edit" attr="image_path" :list="$imageArr" />

                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">渊源内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('family_origin_content') ? ' is-invalid' : '' }}"
                                        id="family_origin_content" name="family_origin_content" placeholder="工作内容" style="max-height:300px" rows="4"
                                        cols="50">{{ old('family_origin_content') ? old('family_origin_content') : $family_origin->family_origin_content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="posted_on" class="col-sm-3 text-end control-label col-form-label">年份</label>
                                <div class="col-sm-2">
                                    <input type="date"
                                        class="form-control{{ $errors->has('particular_year') ? ' is-invalid' : '' }}"
                                        id="particular_year" name="particular_year"
                                        value="{{ old('particular_year') ? old('particular_year') : $family_origin->particular_year }}"
                                        placeholder="年份" />
                                </div>
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">
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
    @endsection

    @section('scriptfile')
        {{-- <script type="text/javascript" src="{{ URL::asset('js/videoEdit.js') }}" defer></script>
          <script type="text/javascript" src="{{ URL::asset('js/imagePreview.js') }}" defer></script> --}}
        {{-- <script type="text/javascript" src="{{ URL::asset('js/mutipleImageHandle.js') }}" defer></script>
        <script type="text/javascript" src="{{ URL::asset('js/mutipleVideoHandle.js') }}" defer></script> --}}
        {{-- <script type="text/javascript" src="{{ URL::asset('js/FileHandle/editImageFileHandling.js') }}" defer></script> --}}
     
    @endsection
