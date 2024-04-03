@inject('theme', 'App\Http\Controllers\User\ThemeController')
<footer id="contact" class="">
    <div style="background-color:{{ $theme->SecondColor()->value }}">
        <div class="d-flex flex-wrap gap-3 justify-content-center p-3" style="font-size: 24">
            <div>
                <img class="img-fluid" src="{{ asset('assets/images/Facebook.png') }}" width="36">
                <a class="text-white" href="{{ $theme->facebook()['link'] }}">{{ $theme->facebook()['label'] }}</a>
            </div>
            <div>
                <img class="img-fluid" src="{{ asset('assets/images/Whatapps.png') }}" width="36">
                <a class="text-white" href="{{ $theme->whatapps()['link'] }}">{{ $theme->whatapps()['label'] }}</a>
            </div>
            <div>
                <img class="img-fluid" src="{{ asset('assets/images/Email.png') }}" width="36">
                <a class="text-white" href="mailto:{{ $theme->email()['link'] }}">{{ $theme->email()['label'] }}</a>
            </div>
        </div>
    </div>
</footer>