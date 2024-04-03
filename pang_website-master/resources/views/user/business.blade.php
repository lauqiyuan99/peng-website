@extends('includes.app')

<style>
    @media (min-width: 991px) {
        li {
            cursor: pointer;
        }

        .mobile-view{
            display: none
        }
    }

    @media (max-width: 991px) {

        #scroll_container,
        .desktop-view {
            display: none !important
        }
    }

</style>
<!-- Theme style -->
<link rel="stylesheet" href="assets/css/adminlte.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@section('content')
    <section class="title">
        <section class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
            <div class="wrapper d-flex flex-column min-h-100">
                <div class="d-flex flex-row gap-3 p-3 border-bottom" style="margin-top: 51px;">
                    <div>
                        <select id="filterCat" class="form-select" aria-label="" id="category" name="category" data-ddl>
                            @foreach ($businessCatList as $key => $value)
                                <option value="{{$key}}" {{$business->category == $key ? 'selected' : ''}}>{{$value}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div>
                        <input type="text" class="form-control" id="search" name="search" placeholder="在此输出工作名称" required />
                    </div> -->
                </div>
                <!-- Main Sidebar Container -->
                <div class="d-flex flex-wrap gap-3 p-3 justify-content-center">
                    @foreach ($businessList as $business)
                    <div data-compare="{{$business->category}}">
                    <a href="{{ route('user.businessDetail', $business->id) }}" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column gap-3 align-items-center p-3">
                            <div>
                                <img class="image-blog" src="{{ asset($business->image_path) }}"
                                                height="200" width="200" />
                            </div>
                            <div class="d-flex flex-column gap-2 align-items-start">
                                <div>{{ $business->name }}</div>
                                <div>{{ $business->address }}</div>
                                <div>{{ $business->category }}</div>
                            </div>
                        </div>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </section>
@endsection
<script type="text/javascript" src="{{ URL::asset('js/filter.js') }}" defer></script>
