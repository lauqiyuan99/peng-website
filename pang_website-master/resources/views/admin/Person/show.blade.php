@extends('layouts.share')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">亲属关系详细资料</h4>
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
                        {{-- <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.relationship.store') }}"> --}}
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">名称</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                        name="name"
                                        value="{{ old('name') ? old('name') : $person->id }} - {{ old('name') ? old('name') : $person->name }}"
                                        placeholder="名称" required disabled />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">头像</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <img src=" {{ asset('image/avatar/' . $person->avatar) }}" height="130"
                                            width="130" style="border:solid">
                                    </div>
                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @for ($i = 0; $i < count($spouseAttrList); $i++)
                                <div class="form-group row">
                                    <label for="spouse_name"
                                        class="col-sm-3 text-end control-label col-form-label">配偶名称{{ $spouseAttrList[$i]['index'] + 1 }}</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('spouse_name') ? ' is-invalid' : '' }}"
                                            id="spouse_name" name="spouse_name" placeholder="未有配偶"
                                            value="{{ old('spouse_name') ? old('spouse_name') : $spouseAttrList[$i]['spouse_name'] }}"
                                            disabled /><br />
                                        @if ($errors->has('spouse_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('spouse_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 text-end control-label col-form-label">配偶头像{{ $spouseAttrList[$i]['index'] + 1 }}</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <img src=" {{ asset('image/avatar/' . $spouseAttrList[$i]['spouse_avatar']) }}"
                                                height="130" width="130" style="border:solid;"> <br /><br />
                                        </div>
                                        @if ($errors->has('spouse_avatar'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('spouse_avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endfor

                            <div class="form-group row">
                                <label for="gender" class="col-sm-3 text-end control-label col-form-label">性别</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="" id="gender" name="gender" disabled>
                                        <option @if (old('gender', $person->gender) == 1) selected @endif value="1">
                                            男
                                        </option>
                                        <option @if (old('gender', $person->gender) == 2) selected @endif value="2">
                                            女
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-sm-3 text-end control-label col-form-label">区域</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" id="state"
                                        name="state" value="{{ old('state') ? old('state') : $person->state }}"
                                        placeholder="州属" required disabled />
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 text-end control-label col-form-label">地址</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address"
                                        name="address" required style="max-height:300px" rows="4" cols="50" disabled>{{ old('address') ? old('address') : $person->address }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nationality" class="col-sm-3 text-end control-label col-form-label">国籍</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}"
                                        id="nationality" name="nationality"
                                        value="{{ old('nationality') ? old('nationality') : $person->nationality }}"
                                        placeholder="国籍" required disabled />
                                    @if ($errors->has('nationality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob_date" class="col-sm-3 text-end control-label col-form-label">出生日期</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control {{ $errors->has('dob_date') ? ' is-invalid' : '' }}"
                                        id="dob_date" name="dob_date"
                                        value="{{ old('dob_date') ? old('dob_date') : date('d/m/Y', strtotime($person->dob_date)) }}"
                                        placeholder="出生日期" required disabled />
                                    @if ($errors->has('dob_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="parent_id" class="col-sm-3 text-end control-label col-form-label">父母</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="" id="parent_id" name="parent_id" disabled>
                                        @if ($person->parent_id)
                                            <option value="{{ $person->parent_id }}">
                                                {{ $person->parent_id }} - {{ $person->parent->name }}
                                            </option>
                                        @endif
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="era" class="col-sm-3 text-end control-label col-form-label">渡马代序</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('era') ? ' is-invalid' : '' }}" id="era"
                                        name="era" value="{{ old('era') ? old('era') : $person->era }}"
                                        placeholder="渡马代序" required disabled />
                                    @if ($errors->has('era'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('era') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="seniority" class="col-sm-3 text-end control-label col-form-label">辈分</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('seniority') ? ' is-invalid' : '' }}"
                                        id="seniority" name="seniority"
                                        value="{{ old('seniority') ? old('seniority') : $person->seniority }}"
                                        placeholder="辈分" required disabled />
                                    @if ($errors->has('seniority'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('seniority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                            <label for="gender" class="col-sm-3 text-end control-label col-form-label">家庭</label>
                            <div class="col-sm-9">
                                <select class="form-select" aria-label="" id="family" name="family" disabled>
                                    <option value="{{$person->family}}">
                                        {{ $person->family }}
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" disabled>
                                    提交
                                </button>
                                <a href="{{ route('admin.relationship.index') }}" class="btn btn-primary"
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
@endsection
