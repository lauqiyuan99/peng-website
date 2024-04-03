@if ($screenMode == 'Add')
    <div class="form-group row">
        <label class="col-sm-3 text-end control-label col-form-label">{{ $labelName }}</label>
        <div class="col-md-9">
            <div class="custom-file">
                <button type="button" class="btn btn-outline-primary" data-img-upload-btn>{{ $btnName }}</button>
                <input type="file" class="custom-file-input{{ $errors->has($attr) ? ' is-invalid' : '' }}"
                    id="{{ $attr }}" name="{{ $inputName }}" accept="image/*" multiple="multiple"
                    data-img-file-upload hidden />
                <br />
                <br />
                <div data-display-image-field class="d-flex flex-row flex-wrap"></div>
            </div>
            @if ($errors->has($attr))
                <span class="text-danger" role="alert">
                    <strong>{{ $errors->first($attr) }}</strong>
                </span>
            @endif
        </div>
    </div>

    <template data-img-template>
        <div data-img-name>
            <img src="" data-display-image id="display" height="130" width="130" style="border:solid;">
            <button type="button" class="btn btn-danger" aria-label="Close" onclick="onDeleteImage(this)"
                style="position:absolute;">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
    </template>

    <script type="text/javascript" src="{{ URL::asset('js/fileAddHandling.js') }}" defer></script>
@endif

@if ($screenMode == 'Edit')
    <div class="form-group row">
        <label class="col-sm-3 text-end control-label col-form-label">{{ $labelName }}</label>
        <div class="col-md-9">
            <div class="custom-file">
                <button type="button" class="btn btn-outline-primary" data-img-upload-btn>{{ $btnName }}</button>
                <input type="file" class="custom-file-input{{ $errors->has($attr) ? ' is-invalid' : '' }}"
                    id="{{ $attr }}" name="{{ $inputName }}" accept="image/*" multiple="multiple"
                    data-img-file-upload hidden />
                <br />
                <br />
                @if ($list[0] == 'storage/noimage.jpg')
                    <div data-display-image-field class="d-flex flex-row flex-wrap"></div>
                @else
                    <div data-display-image-field class="d-flex flex-row flex-wrap">
                        @foreach ($list as $imgFile)
                            <div data-img-name="{{ $imgFile }}">
                                <img src=" {{ asset($imgFile) }}" height="130" width="130" style="border:solid">
                                <button type="button" class="btn btn-danger" aria-label="Close"
                                    onclick="onDeletePreviousImage(this)">
                                    <span aria-hidden="true">&times;</span>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($errors->has($attr))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first($attr) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <template data-img-template>
            <div data-img-name>
                <img src="" data-display-image id="display" height="130" width="130"
                    style="border:solid">
                <button type="button" class="btn btn-danger" aria-label="Close" onclick="onDeleteCurrentImage(this)">
                    <span aria-hidden="true">&times;</span>
            </div>
        </template>
        <script type="text/javascript" src="{{ URL::asset('js/fileEditHandling.js') }}" defer></script>
@endif
