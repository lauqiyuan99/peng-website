@extends('includes.app')

@section('content')
    <section class="title">
        <div><br /></div>
        <div class="text-center h1 p-auto mt-5"><b><ins>通告</ins></b></div>
    </section>
    @inject('theme', 'App\Http\Controllers\User\ThemeController')
    <section class="content flex-grow-1">
        <div class="row" style="margin-right: 0px !important; margin-left: 0px !important;">
            {{-- @foreach ($noticeList as $notice)
            @if ($notice->notice_title_image_path != null)
            <div class="w-auto d-flex justify-content-start m-2">
                <img class="image-blog" src="{{ asset('image/notice/' . $notice->notice_title_image_path) }}" height="300" width="400">
            </div>        
            @elseif(($notice->media_path != null))
            <div class="w-auto d-flex justify-content-start m-2">                             
                <video class="embed-responsive-item  video-blog" width="400" height="300" src="{{ asset('assets/videos/notice/' . $notice->media_path)}}" title="URL video player" allowfullscreen="" controls="0" sandbox="" frameborder="0" scrolling="no"></video>                                                    
            </div>
            @endif 
            <div class="d-flex flex-column gap-3 col-xl-8 col-md-8 col-12 p-1 mt-1 ">
                <b><h4>标题: {{ $notice->notice_name }}</h4></b>
                <div>详情: <br> {!! $notice->notice_content !!}</div>
            </div>                         
        @endforeach --}}
            @foreach ($noticeList as $key => $notice)
            @if ($imageArr[$key])
                <div class="w-auto d-flex justify-content-start m-2">
                        @foreach ($imageArr[$key] as $imgFile)
                            @if($imgFile != 'storage/noimage.jpg')
                                <img class="image-blog" src="{{ asset($imgFile) }}" height="300" width="400">
                            @endif
                        @endforeach
                </div>
            @endif
            @if ($videoArr[$key])
                <div class="w-auto d-flex justify-content-start m-2">
                    @foreach ($videoArr[$key] as $videoFile)
                        @if ($videoFile != 'noVideo')
                            <video class="embed-responsive-item  video-blog" height="300" src="{{ asset($videoFile) }}"
                                title="URL video player" allowfullscreen="" controls="0" sandbox="" frameborder="0"
                                scrolling="no"></video>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        <div class="d-flex flex-column gap-3 col-xl-8 col-md-8 col-12 p-1 mt-1 ">
            <b>
                <h4>标题: {{ $notice->notice_name }}</h4>
            </b>
            <div>详情: <br> {!! $notice->notice_content !!}</div>
        </div>
        @endforeach

        </div>
    </section>
    </div>

    <style>
        @media (max-width: 410px) {
            .image-blog {
                width: 200px;
                height: 200px
            }

            .video-blog {
                width: 200px;
                height: 200px
            }
        }
    </style>
