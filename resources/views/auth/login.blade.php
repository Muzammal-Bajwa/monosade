
<x-guest-layout>
@section('page-title') {{__('Login')}} @endsection
<?php
$dir = base_path() . '/resources/lang/';
$glob = glob($dir . "*", GLOB_ONLYDIR);
$arrLang = array_map(function ($value) use ($dir){
    return str_replace($dir, '', $value);
}, $glob);
$arrLang = array_map(function ($value) use ($dir){
    return preg_replace('/[0-9]+/', '', $value);
}, $arrLang);
$arrLang = array_filter($arrLang);
$currantLang = basename(App::getLocale());
$client_keyword = Request::route()->getName() == 'client.login' ? 'client.' : ''
?>
@section('content')
<section id="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 col-sm-6 flush">
                    <div class="content_side">
                        <a class="logo" href="#"><img src="{{ asset('public/new_assets/assets/img/logo_main.png')}}"/></a>
                        <h1>Welcome to<br/>
                            <span>Monoshade</span></h1>
                        <p>We make it easy for everyone to <br/> 
                            get high-quality graphics.</p>
                            <form method="POST" id="form_data" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mearge">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Enter Your Email') }}">
                              @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="{{ __('Enter Your Password') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="align_f">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                                <a href="{{ route('password.request', $lang) }}">Forgot password?</a>
                            </div>
                            @if(env('RECAPTCHA_MODULE') == 'on')
                                <div class="form-group col-lg-12 col-md-12 mt-3">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                    <span class="small text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endif
                            <span class="btn_align">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                <a href="{{ route('register', $lang) }}" class="sign_up_btn">Sign Up</a>
                                <a href="{{route('client.login', $lang)}}" class="sign_up_btn"  >{{ __('Client Login') }}</a>
                            </span>
                        </form>
                    </div>
                </div>
                <div class="col-12  col-lg-6 col-sm-6 flush">
                    <div class="slider_side">
                        <!-- <img src="assets/img/big_img.png" class="img-responsive img-centered" alt="" /> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('custom-scripts')
@if(env('RECAPTCHA_MODULE') == 'on')
        {!! NoCaptcha::renderJs() !!}
@endif
@endpush
</x-guest-layout>
