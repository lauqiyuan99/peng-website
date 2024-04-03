@props(['person'])
@php
$numofRecord = count($person);
@endphp
@for ($i = 0; $i < count($person); $i++) <div class="form-group row" id="spouse{{$person[$i]['index']+1}}">
    <label for="spouse_name"
        class="col-sm-3 text-end control-label col-form-label">配偶名称{{$person[$i]['index']+1}}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control{{ $errors->has('spouse_name') ? ' is-invalid' : '' }}" id="spouse_name"
            name="spouse_name[]" placeholder="未有配偶"
            value="{{ old('spouse_name') ? old('spouse_name') : $person[$i]['spouse_name'] }}" /><br />
        @if ($errors->has('spouse_name'))
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('spouse_name') }}</strong>
        </span>
        @endif
    </div>



    <label class="col-sm-3 text-end control-label col-form-label">配偶头像 {{$person[$i]['index']+1}}</label>
    <div class="col-md-9">
        <input type="hidden" id='numofRecord' value="{{$numofRecord}}" style="display:none">
        <div class="custom-file">
            <input type="file" class="custom-file-input{{ $errors->has('spouse_avatar') ? ' is-invalid' : '' }}"
                id="spouse_avatar{{$person[$i]['index']+1}}" name="spouse_avatar[]"
                onchange="previewImage(event,{{$person[$i]['index']+1}});" accept="image/*" />
            <br /><br />
            <img src=" {{ asset('image/avatar/' . $person[$i]['spouse_avatar']) }}"
                id="display{{$person[$i]['index']+1}}" height="130" width="130" style="border:solid;">
        </div>
        <br />
        @if ($errors->has('spouse_avatar'))
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('spouse_avatar') }}</strong>
        </span>
        @endif
    </div>



    <div class="form-group row">
        <label class="col-sm-3 text-end control-label col-form-label hidden"></label>
        <div class="col-md-9">
            <button type="button" id="{{$person[$i]['index']+1}}" name="cancelCurrentSpouse" class="btn btn-primary"
                onClick="deleteCurrentSpouse(this.id)" title="移除配偶">{{
                __('移除配偶') }}</button>
        </div>
    </div>
    </div>
    @endfor

    <input type='hidden' id="storeSpouseImgSrc" name="storeSpouseImgSrc">
    <div id="addMoreSpouseName">
    </div>
    <div id="addMoreSpouseAvatar">