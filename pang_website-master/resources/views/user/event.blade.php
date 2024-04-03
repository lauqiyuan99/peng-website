@extends('includes.app')

@section('content')
<section class="title">
    <div><br/></div>
    <div class="text-center h1 p-auto mt-5"><b><ins>活动</ins></b></div>
</section>
@inject('theme', 'App\Http\Controllers\User\ThemeController')
<section class="content flex-grow-1">
    <div class="row" style="margin-right: 0px !important; margin-left: 0px !important;">
    {{-- @foreach ($eventList as $event)
        <div class="w-auto d-flex justify-content-start m-2">
            <img class="image-blog" src="{{ asset($event->event_title_image_path) }}" height="300" width="400">
        </div>        
        <div class="w-auto d-flex justify-content-start m-2">                             
            <video class="embed-responsive-item  video-blog" width="400" height="300" src="{{ asset($event->media_path) }}" title="URL video player" allowfullscreen="" controls="0" sandbox="" frameborder="0" scrolling="no"></video>                                                    
        </div>
        <div class="d-flex flex-column gap-3 col-xl-8 col-md-8 col-12 p-1 mt-1 ">
            <b><h4>标题: {{ $event->event_name }}</h4></b>
            <div>详情: <br> {!! $event->event_content !!}</div>
        </div>                         
    @endforeach --}}
    @foreach ($eventList as $key=>$event)
        @if($imageArr[$key])
            <div class="w-auto d-flex justify-content-start m-2">
                @foreach ($imageArr[$key] as $imgFile)
                    @if($imgFile != 'storage/noimage.jpg')
                        <img class="image-blog" src="{{ asset($imgFile) }}" height="300" width="400">
                    @endif              
                @endforeach
            </div>
        @endif
        @if($videoArr[$key])
            <div class="w-auto d-flex justify-content-start m-2">    
                @foreach ($videoArr[$key] as $videoFile)
                    @if ($videoFile != 'noVideo')
                        <video class="embed-responsive-item  video-blog" height="300"
                        src="{{ asset($videoFile) }}" title="URL video player" allowfullscreen="" controls="0"
                        sandbox="" frameborder="0" scrolling="no"></video>
                    @endif
                @endforeach
            </div>
        @endif
        </div>        
        <div class="d-flex flex-column gap-3 col-xl-8 col-md-8 col-12 p-1 mt-1 ">
            <b><h4>标题: {{ $event->event_name }}</h4></b>
        <div>详情: <br> {!! $event->event_content !!}</div>
        </div>                         
    @endforeach
    </div>      
</section>
</div>

<style>
    @media (max-width: 410px)  {
        .image-blog{
            width: 200px;
            height: 200px
        }
        .video-blog{
            width: 200px;
            height: 200px
        }
    }

</style>