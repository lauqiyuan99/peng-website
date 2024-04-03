@extends('includes.app')
<style>
    li {
        cursor: pointer;
    }

    .border-radius {
        border: 2px solid black;
        border-radius: 25px;
    }

    @media (max-width: 991px) {
        .mobile-history-list {
            display: none;
        }
        .wrapper {
            width: 100%;
            height: 100px;
            margin: 50px auto 0 auto;
            position: relative;
            overflow: scroll;
        }
    }

    @media (min-width: 991px) {
        .desktop-history-list {
            display: none;
        }
        
    }
</style>
@section('content')
<section class="content" style="margin-top: 52px">
    <div class="row m-0">
        <!-- Desktop view side bar -->
        <div class="desktop-history-list">
            <div class="wrapper m-2">
                    <ul class="list-group flex-row m-3">
                        @foreach ($currentPersonHistory as $history)
                        <li class="border-radius row m-1" onclick="onClick({{$history->id}})">
                                <div class="d-flex flex-row gap-3 mx-2 my-2 align-items-center">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <span class="ml-2 w-75">
                                        {{ $history->onlyIncidentYear }}
                                    </span>
                                    {{-- <i class="fas fa-angle-right m-auto"></i> --}}
                                </div>
                        </li>
                        @endforeach
                    </ul>
            </div>
        </div>
        <!-- Mobile view side bar -->
        <div class="col-2 mobile-history-list">
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column gap-2" data-widget="treeview" role="menu" data-accordion="false">
                        @foreach ($currentPersonHistory as $history)
                        <li class="nav-item border-radius list-show" onclick="onClick({{$history->id}})">
                            <div class="d-flex flex-row gap-3 mx-3 my-2 align-items-center">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <span class="ml-2 w-75">
                                    {{ $history->onlyIncidentYear }}
                                </span>
                                {{-- <i class="fas fa-angle-right m-auto"></i> --}}
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Content view -->
        <div class="col-10">
            <div>
                <div class="d-flex align-items-center flex-column" id="scroll_container">
                    <div class="h1 mt-5" id="history_name"><b><ins>事迹</ins></b></div>
                    <div class="w-auto d-flex justify-content-start m-2">
                        <p id="numOfHistory">
                            @if ($numOfHistory === 0)
                            此人没有任何事迹
                            @else
                            此人拥有{{$numOfHistory}}个事迹
                            选择一个事迹以查看详情
                            @endif
                        </p>
                    </div>
                </div>
                @foreach($currentPersonHistory as $key=> $history)
                <div data-id="{{$history->id}}" style="display:none" data-name="{{$history->history_name}}">
                    <div class="d-flex col-xl-8 col-md-8 col-12 p-1 mt-1 ">
                        <div>
                            此事件发生于：{{$history->incident_date}} <br>
                            人物：{{$history->people_id}}<br>
                            事件内容: {{$history->description}}
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 w-100 justify-content-around align-items-start m-3">
                        @foreach($imageArr[$key] as $imgFile)
                        @if($imgFile =='storage/noimage.jpg')
                        @else
                        <img src=" {{ asset($imgFile) }}" class="image-blog" style="border: solid; width: 80%" />
                        @endif
                        @endforeach


                        @foreach($videoArr[$key] as $video)
                        @if ($video == 'noVideo')
                        @else
                        <video class="embed-responsive-item video-blog" style="width: 80%" src="{{ asset($video)}}" title="URL video player" allowfullscreen="" controls="0" sandbox="" frameborder="0" scrolling="no"></video>
                        @endif
                        @endforeach



                    </div>
                </div>
                @endforeach

            </div>
        </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ URL::asset('js/peoplehistory.js') }}"></script>
@endsection