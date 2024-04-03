@extends('includes.app')

@section('content')
@inject('theme', 'App\Http\Controllers\User\ThemeController')
    <div class="mt-5">
        <img src="{{ $theme->bannerImage() }}" class="img-fluid w-100"/>
    </div>

    <img src="{{ $theme->bgImage() }}" class="img-fluid w-100"/>
@endsection