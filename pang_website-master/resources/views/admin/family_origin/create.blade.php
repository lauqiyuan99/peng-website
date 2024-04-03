@extends('layouts.share')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">添加渊源</h4>
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
                        action="{{ route('admin.family_origin.store') }}">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <x-vid-upload labelName="渊源视频" btnName="上传视频" inputName="media_path[]" screenMode="Add"
                                attr="media_path" list="" />
                            <x-img-upload labelName="渊源照片" btnName="上传照片" inputName="image_path[]" screenMode="Add"
                                attr="image_path" list="" />

                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">渊源内容</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('family_origin_content') ? ' is-invalid' : '' }}"
                                        id="family_origin_content" name="family_origin_content" value="{{ old('family_origin_content') }}"
                                        placeholder="工作内容" style="max-height:300px" rows="4" cols="50"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="url" class="col-sm-3 text-end control-label col-form-label">年份</label>
                                <div class="col-sm-9">
                                    <input type="date" id="particular_year" name="particular_year" lang="zh-CN">   
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
    @endsection
