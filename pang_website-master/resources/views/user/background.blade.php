@extends('includes.app')

@section('content')
    <section class="title">
        <div><br /></div>
        <div class="text-center h1 p-auto mt-5"><b><ins>彭姓渊源</ins></b></div>
    </section>
    @inject('theme', 'App\Http\Controllers\User\ThemeController')
    <section class="content">
        @foreach ($family_origin_list as $key=>$family_origin)
            {{-- @php
                $image_path = $family_origin->image_path == 'noimage.jpg' ? 'image/' . $family_origin->image_path : 'image/family_origin/' . $family_origin->image_path;
            @endphp --}}
            <div class="d-flex flex-column m-3 p-2 gap-3 border rounded">
                <div class="d-flex flex-row">
                    <b style="min-width: 48px">日期：</b>
                    <span class="flex-grow-1">
                        {{ $family_origin->particular_year }}
                    </span>
                </div>
                <div class="d-flex flex-row">
                    <b style="min-width: 48px">内容：</b>
                    <span class="flex-grow-1">
                        {{ $family_origin->family_origin_content }}
                    </span>
                </div>
                <div class="d-flex flex-row gap-2 w-100" style="overflow: auto">
                    @if($imageArr[$key])
                        @foreach ($imageArr[$key] as $imgFile)
                        <img src=" {{ asset($imgFile) }}" height="300" class="image-blog">                       
                        @endforeach
                    
                    @endif
                    @if($videoArr[$key])
                        @foreach ($videoArr[$key] as $videoFile)
                        <video class="embed-responsive-item  video-blog" height="300"
                        src="{{ asset($videoFile) }}" title="URL video player" allowfullscreen="" controls="0"
                        sandbox="" frameborder="0" scrolling="no"></video>
                        @endforeach
                    @endif

                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-end">{{ $family_origin_list->links() }}</div>
    </section>

    <div class="section position-relative">
        <div class="arrow arrow-left">
            <img src="{{ asset('assets/images/arrow-left.png') }}" />
        </div>
        <div class="arrow arrow-right">
            <img src="{{ asset('assets/images/arrow-right.png') }}" />
        </div>
        <div class="scrollmenu" style="background-color: {{ $theme->primaryColor()->value }};">
            @foreach ($year_list as $year)
                {{-- <button>#{{$year}}</button> --}}
                {{-- <a id="year" href="{{ route('getRecordByYear', $year) }}">{{ $year }}</a> --}}
                <a id="year" href="/getList/{{ $year }}">{{ $year }}</a>
            @endforeach
        </div>

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

        .scrollmenu {
            overflow: auto;
            white-space: nowrap;
        }

        .scrollmenu a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 7px 21px;
            width: 80;
            text-decoration: none;
        }

        .scrollmenu a:hover {
            background-color: {{ $theme->secondColor()->value }};
            border-radius: 15px 15px 0px 0px
        }

        .arrow {
            position: absolute;
            height: 38px;
            text-align: center;
            padding: 7px;
        }

        .arrow-right {
            right: 0;
        }
    </style>

    <script>
        $(".arrow-left").hide();

        $(".scrollmenu").scroll(function() {
            if ($(".scrollmenu").scrollLeft() == 0) {
                $(".arrow-left").hide();
            } else {
                $(".arrow-left").show();
            }

            if (($(".scrollmenu").scrollLeft() + $(window).width()) == $(".scrollmenu").get(0).scrollWidth) {
                $(".arrow-right").hide();
            } else {
                $(".arrow-right").show();
            }
        });

        $(".arrow-left").click(function() {
            $(".scrollmenu").scrollLeft($(".scrollmenu").scrollLeft() - 84);
        });

        $(".arrow-right").click(function() {
            $(".scrollmenu").scrollLeft($(".scrollmenu").scrollLeft() + 84);
        });
    </script>
@endsection
