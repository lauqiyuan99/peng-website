@extends('includes.app')

@section('content')
<!-- <section class="search-sec pt-5">
    <div class="container">
        <form action="{{ route('search.index') }}" method="GET">
            {{ csrf_field() }}
            <div class="row d-flex justify-content-center align-items-center p-3">
                <div class="col-9">
                    <input type="text" id="search_text" name="search_text"
                        class="form-control search-slt border border-dark" value="{{ request('search_text') }}"
                        style="border-radius: 20px" placeholder="輸入名字">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn border border-dark text-black bg-white"
                        style="border-radius: 20px">搜索</button>
                </div>
            </div>
        </form>
    </div>
</section> -->
@inject('theme', 'App\Http\Controllers\User\ThemeController')
<section class="content pt-5">
    <div class="container my-3 p-2">
        <div class="d-flex flex-wrap">
            @foreach($search_persons as $search_person)
                <div class="col-xl-3 col-md-4 col-12 p-2">
                    <a href="/chart/{{$search_person->id}}" class="text-decoration-none">
                        <div class="card d-flex flex-column gap-2 p-3 text-white" style="background-color:  {{ $theme->secondColor()->value }};">
                            <div class="d-flex flex-row justify-content-center">
                                <img src="{{ asset('image/avatar/'.$search_person->avatar) }}" height="100" width="100" />
                            </div>
                            <div class="bg-white text-dark py-2 px-3" style="border-radius: 20px">
                                <span>{{ $search_person->name }}</span>
                            </div>
                            <div class="d-flex flex-column gap-2 bg-white text-dark py-2 px-3 mt-2">
                                <div>
                                    <b>性别 :</b> {{ $search_person->gender == 1 ? '男' : '女'}}
                                </div>
                                <div>
                                    <b>渡马代序 :</b> {{ $search_person->era }}
                                </div>
                                <div>
                                    <b>州属 :</b> {{ $search_person->state }}
                                </div>
                                <div>
                                    <b>年份 :</b> {{ $search_person->dob_date }} ～ {{ $search_person->dead_date }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{-- <div>{{ $search_persons->render() }}</div> --}}
    </div>
    </div>
</section>

<style>
    a:hover {
        text-decoration: none;
    }
</style>
@endsection