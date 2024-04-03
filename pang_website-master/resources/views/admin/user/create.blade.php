@extends('layouts.share')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">添加管理员</h4>
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
                                action="{{ route('admin.user.store') }}">
                                {!! csrf_field() !!}
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-end control-label col-form-label">名称</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" name="name" value="{{ old('name') }}" placeholder="名称"
                                                required />
                                            @if ($errors->has('name'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 text-end control-label col-form-label">用户名</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                id="username" name="username" value="{{ old('username') }}" placeholder="用户名"
                                                required />
                                            @if ($errors->has('username'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-sm-3 text-end control-label col-form-label">电子邮件</label>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                id="email" name="email" placeholder="电子邮件"
                                                value="{{ old('email') }}" required autocomplete="email" />
                                            @if ($errors->has('email'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-sm-3 text-end control-label col-form-label">密码</label>
                                        <div class="col-sm-9">
                                            <input type="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                id="password" name="password" placeholder="密码" required
                                                autocomplete="email" />
                                            @if ($errors->has('password'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-3 text-end control-label col-form-label">权限</label>
                                        <div class="col-sm-9">
                                            <select class="form-select" aria-label="" id="role" name="role" required>
                                                <option value="staff">管理员</option>
                                                <!-- <option value="superadmin">超管</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">
                                            提交
                                        </button>
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
