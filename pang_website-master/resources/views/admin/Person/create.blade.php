@extends('layouts.share')
@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">添加亲属关系资料</h4>
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
                        action="{{ route('admin.relationship.store') }}">
                        @csrf
                        {{-- {!! csrf_field() !!} --}}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">名称</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="名称"  />
                                    @if ($errors->has('name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">头像</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input{{ $errors->has('avatar') ? ' is-invalid' : '' }}"
                                            id="avatar" name="avatar" onchange="previewImage(event,0);"
                                            accept="image/*" />
                                        <br />
                                        <br />
                                        <img src="{{ asset('image/avatar/noimage.jpg') }}" id="display0" height="130"
                                            width="130" style="border:solid">
                                    </div>
                                    @if ($errors->has('avatar'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="spouse_name" class="col-sm-3 text-end control-label col-form-label">配偶名称</label>
                                <div class="col-sm-9" id="dynamicAddRemove">
                                    <input type="text"
                                        class="form-control{{ $errors->has('spouse_name') ? ' is-invalid' : '' }}"
                                        id="spouse_name" name="spouse_name[]" placeholder="配偶名称" />
                                    @if ($errors->has('spouse_name'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('spouse_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-end control-label col-form-label">配偶头像</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input{{ $errors->has('spouse_avatar') ? ' is-invalid' : '' }}"
                                            id="spouse_avatar1" name="spouse_avatar[]" onchange="previewImage(event,1);"
                                            accept="image/*" />
                                        <br />
                                        <br />
                                        <img src="{{ asset('image/avatar/noimage.jpg') }}" id="display1" height="130"
                                            width="130" style="border:solid">
                                        <br />
                                    </div>
                                    @if ($errors->has('spouse_avatar'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('spouse_avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- for extra spouse usage --}}
                            <input type='hidden' id="numofSpouse" name="numofSpouse" value='2'>
                            <input type='hidden' id="storeSpouseImgSrc" name="storeSpouseImgSrc">
                            <div id="addMoreSpouseName">
                            </div>
                            <div id="addMoreSpouseAvatar">
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label hidden"></label>
                                    <div class="col-md-9">
                                        <a href="" id="addmorespouse" name="addmorespouse"
                                            class="link-primary btn btn-primary" title="添加配偶">{{ __('添加配偶') }}</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label hidden"></label>
                                    <div class="col-md-9">
                                        <a href="" id="cancelCurrentSpouse" name="cancelCurrentSpouse"
                                            class="link-primary disabled" style="pointer-events: none; color:grey;"
                                            title="移除配偶">{{ __('移除配偶') }}</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 text-end control-label col-form-label">性别</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="" id="gender" name="gender"
                                            >
                                            <option value="1">男</option>
                                            <option value="2">女</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="negeri"
                                        class="col-sm-3 text-end control-label col-form-label">州属</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="" id="negeri" name="negeri">
                                            @foreach ($negeriList as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $key == old('negeri') ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('negeri'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('negeri') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="state"
                                        class="col-sm-3 text-end control-label col-form-label">区域</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                            id="state" name="state" value="{{ old('state') }}" placeholder="区域"
                                             />
                                        @if ($errors->has('state'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address"
                                        class="col-sm-3 text-end control-label col-form-label">地址</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address"
                                            name="address" placeholder="地址" style="max-height:300px" rows="4" cols="50"></textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="nationality"
                                        class="col-sm-3 text-end control-label col-form-label">国籍</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}"
                                            id="nationality" name="nationality" value="马来西亚" placeholder="国籍"
                                             />
                                        @if ($errors->has('nationality'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('nationality') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob_date"
                                        class="col-sm-3 text-end control-label col-form-label">出生日期</label>
                                    <div class="col-sm-2">
                                        <input type="date"
                                            class="form-control date-inputmask{{ $errors->has('dob_date') ? ' is-invalid' : '' }}"
                                            id="dob_date" name="dob_date" value="{{ old('dob_date') }}"
                                            placeholder="出生日期"  />
                                        @if ($errors->has('dob_date'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('dob_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dead_date"
                                        class="col-sm-3 text-end control-label col-form-label">往生日期</label>
                                    <div class="col-sm-2">
                                        <input type="date"
                                            class="form-control date-inputmask{{ $errors->has('dead_date') ? ' is-invalid' : '' }}"
                                            id="dead_date" name="dead_date" value="{{ old('dead_date') }}"
                                            placeholder="往生日期" />
                                        @if ($errors->has('dead_date'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('dead_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <x-data-input-list labelFor="parent_id" labelName="父母" :lists="$persons"
                                attr="parent_id" selected=""  />
                                <div class="form-group row">
                                    <label for="era"
                                        class="col-sm-3 text-end control-label col-form-label">渡马代序</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('era') ? ' is-invalid' : '' }}"
                                            id="era" name="era" value="{{ old('era') }}"
                                            placeholder="渡马代序"  />
                                        @if ($errors->has('era'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('era') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="seniority"
                                        class="col-sm-3 text-end control-label col-form-label">辈分</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control{{ $errors->has('seniority') ? ' is-invalid' : '' }}"
                                            id="seniority" name="seniority" value="{{ old('seniority') }}"
                                            placeholder="辈分"  />
                                        @if ($errors->has('seniority'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('seniority') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" id="btnSubmit" class="btn btn-primary">
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
    @endsection

    @section('js')
        <script>
            var spouseImgArr = [];
            $(document).ready(function() {
                var counter = 1;

                $("#btnSubmit").on("click", function() {
                    //Pass back to controller
                    var imgSrcArr = $('input[id*="spouse_avatar"]');
                    for (var i = 0; i < imgSrcArr.length; i++) {
                        if (imgSrcArr[i].files[0] == null) {
                            spouseImgArr.push("noimage.jpg");
                        } else {
                            spouseImgArr.push(imgSrcArr[i].files[0].name);
                        }
                    }
                    $('#storeSpouseImgSrc').val(spouseImgArr);

                });

                //Add more spouse
                $("#addmorespouse").on("click", function(e) {
                    e.preventDefault();
                    counter = counter + 1;
                    $('#numofSpouse').val(counter);
                    $('#addMoreSpouseName').append("<div id='spouse" + counter +
                        "' class='form-group row'><label for='spouse_name'class='col-sm-3 text-end control-label col-form-label'>配偶名称" +
                        counter +
                        "</label><div class='col-sm-9'> <input name='spouse_name[]' type='text' class='form-control' id='spouse_name' placeholder='配偶名称'></div><br /><br /><label class='col-sm-3 text-end control-label col-form-label'>配偶头像" +
                        counter +
                        "</label><div class='col-md-9'><div class='custom-file'> <input type='file' class='custom-file-input' id='spouse_avatar" +
                        counter + "' name='spouse_avatar[]' onchange='previewImage(event," + counter +
                        ")' accept='image/*''/><br /><br /><img id='display" + counter +
                        "' height='130'width='130' style='border:solid;' src='{{ URL::asset('image/avatar/noimage.jpg') }}' /></div>"
                        );
                    document.getElementById("cancelCurrentSpouse").style.pointerEvents = "auto";
                    $('#cancelCurrentSpouse').css('color', '#7460ee');
                });


                // Cancel Spouse
                $("#cancelCurrentSpouse").on("click", function(e) {
                    e.preventDefault();
                    var containner = 'spouse' + counter;
                    $('#' + containner).remove();
                    counter = counter - 1;
                    disabledChecking(counter);
                });
            });


            // Image Preview Usage
            function previewImage(event, key) {
                var control = 'display' + key;
                var ext = $(event.target).val().split('.').pop().toLowerCase();
                if (event.target.files.length > 0 && $.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $(event.target).attr('type', '');
                    $(event.target).attr('type', 'file');
                    $('#' + control).attr('src', "{{ URL::asset('/image/avatar/noimage.jpg') }}");
                    alert('只有照片是被允许的');
                    return;
                }
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById(control);
                preview.src = src;
                preview.style.display = "block";
            }

            //disbale link when only 1 spouse left
            function disabledChecking(counter) {
                if (counter == 1) {
                    document.getElementById("cancelCurrentSpouse").style.pointerEvents = "none";
                    $('#cancelCurrentSpouse').css('color', 'grey');
                }
            }
        </script>
    @endsection
