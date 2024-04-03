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
                                {{-- <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.user.store') }}"> --}}
                                {!! csrf_field() !!}
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-end control-label col-form-label">名称</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" name="name"
                                                value="{{ old('name') ? old('name') : $user->name }}"
                                                placeholder="名称" required disabled />
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
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
                                                placeholder="名称" required disabled />
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
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
                                                value="{{ old('email') ? old('email') : $user->email }}" required
                                                autocomplete="email" disabled />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role"
                                            class="col-sm-3 text-end control-label col-form-label">权限</label>
                                        <div class="col-sm-9">
                                            <input type="role"
                                                class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                                id="role" name="role" placeholder="电子邮件"
                                                value="{{ $user->role == 'staff' ? '管理员' : '超管' }}" required
                                                autocomplete="role" disabled />
                                        </div>
                                    </div>
                                {{-- <div class="form-group row hidden">
                                        <label for="password" class="col-sm-3 text-end control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input
                                            type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            id="password" name="password"
                                            placeholder="Password" required autocomplete="email"
                                            />
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary" disabled>
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
