@extends('includes.app')

@section('content')
    <div class="mt-5 px-5 py-3">
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-row gap-3">
                @if($imageArr)
                    @foreach ($imageArr as $imgFile)
                        <img src="{{ asset($imgFile) }}" height="200" width="200" alt="" />                    
                    @endforeach
               @endif
            </div>
            <div class="d-flex flex-column gap-3" style="font-size: 24px">
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>商业名称:</b>
                    </div>
                    <div class="d-flex">
                        {{ $businessDetail->name }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>商业种类:</b>
                    </div>
                    <div class="d-flex">
                        {{ $businessDetail->category }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>商业地址:</b>
                    </div>
                    <div class="d-flex">
                        {{ $businessDetail->address }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>商业内容:</b>
                    </div>
                    <div class="d-flex">
                        {{ $businessDetail->description }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>商业背景:</b>
                    </div>
                    <div class="d-flex">
                        {{ $businessDetail->background }}
                    </div>
                </div>
                @if($jobList->count() > 0)
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <b>就业机会:</b>
                        </div>
                        <div class="d-flex flex-wrap gap-3" data-list="{{$jobList}}">
                            @foreach ($jobList as $job)
                            <div data-compare="{{$job->category}}">
                                <a href="{{ route('jobDetail.show', $job->id) }}" class="text-decoration-none text-dark" >
                                    <div class="card d-flex flex-column gap-3 align-items-center p-3">
                                        <div>
                                            <img class="image-blog" src="{{ asset($job->image_path) }}"
                                                height="200" width="200" />
                                        </div>
                                        <div class="d-flex flex-column gap-2 align-items-start" data-container >
                                            <div>{{ $job->name }}</div>
                                            <div >{{ $job->address }}</div>
                                            <div>{{ $job->category }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
