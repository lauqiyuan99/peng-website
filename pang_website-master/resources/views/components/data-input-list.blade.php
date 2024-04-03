<div class="form-group row">
    <label for="{{$labelFor}}" class="col-sm-3 text-end control-label col-form-label" data-label="{{$labelName}}">{{$labelName}}</label>
    <div class="col-sm-2">
        <input list="{{$attr}}" type="text" name="{{$attr}}" class="form-control"
        {{ $required ?? '' }} data-input-list value="{{$selected}}">
        <datalist id="{{$attr}}" class="dropdown-menu" data-dt-list>  
                @foreach ($lists as $item)
                <option value="{{$item->name}}"></option>
                @endforeach
        </datalist>
        <span class="text-danger" data-span hidden>
        </span>
        @if ($errors->has($attr))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first($attr) }}</strong>
            </span>
        @endif
    </div>
</div>


<script type="text/javascript" src="{{ URL::asset('js/inputDataListValidation.js') }}" defer></script>