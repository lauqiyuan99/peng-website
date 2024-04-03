@extends('includes.app')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
@endsection

@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <form method="POST" action="" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                {{csrf_field()}}
                {{ method_field('PATCH') }}

                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <div style="height: 100px"></div>
                        <label for="content" class="{{ $errors->has('content') ? "error" : "" }}">
                            Content
                        </label>
                        <!-- summernote editor textarea -->
                        <textarea class="summernote" name="content">testing summernote</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                            <strong style="color: red">{{ $errors->first('content') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" name="action" value="save" class="btn btn-brand">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var SummernoteDemo={init:function(){$(".summernote").summernote({
                fontNames: ['Neo Sans'],
                height: 500
            })}};

        jQuery(document).ready(function(){SummernoteDemo.init()});
    </script>
@endsection