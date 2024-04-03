@extends('includes.app')

@section('content')
    <div class="mt-5 px-5 py-3">
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-row gap-3">
                @if($imageArr)
                    @foreach ($imageArr as $imgFile)
                        <img src=" {{ asset($imgFile) }}" height="200" width="200" />                       
                    @endforeach
               @endif
            </div>
            <div class="d-flex flex-column gap-3" style="font-size: 24px">
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>工作名称:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->name }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>工作种类:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->category }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>公司地址:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->address }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>薪水:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->salary }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>发布于:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->posted_on }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>工作内容:</b>
                    </div>
                    <div class="d-flex">
                        {{ $jobDetail->description }}
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="col-2">
                        <b>注意事项:</b>
                    </div>
                    <div class="d-flex">
                        {!! $jobDetail->note !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
