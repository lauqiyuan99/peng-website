@extends('layouts.share')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">更改管理员资料</h4>
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
                                action="{{ route('admin.user.update', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-end control-label col-form-label">名称</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" name="name"
                                                value="{{ old('name') ? old('name') : $user->name }}"
                                                placeholder="名称" required />
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
                                                id="username" name="username"
                                                value="{{ old('username') ? old('username') : $user->username }}"
                                                placeholder="用户名" required disabled />
                                            @if ($errors->has('username'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-end control-label col-form-label">电子邮件</label>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                id="email" name="email" placeholder="电子邮件"
                                                value="{{ old('email') ? old('email') : $user->email }}" required
                                                autocomplete="email" disabled />
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
                                                id="password" name="password" value=""
                                                placeholder="请重新输入密码或输入新密码"
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
                                            <select class="form-select" aria-label="" id="role" name="role">
                                                <option @if (old('role', $user->role) == 'staff') selected @endif value="staff">
                                                    管理员
                                                </option>
                                                <!-- <option @if (old('role', $user->role) == 'superadmin') selected @endif value="superadmin">
                                                    超管
                                                </option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">
                                            提交
                                        </button>
                                        <a href="{{ route('admin.user.index') }}" class="btn btn-primary"
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
