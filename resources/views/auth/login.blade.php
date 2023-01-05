<x-guest-layout>
    <x-auth-card>  

@section('page-title') {{__('Login')}} @endsection
@section('content')

                <div class="card" style="margin-bottom: 120px !important">
                <div class="row align-items-center text-start">
                    <div class="col-xl-6">
                        <div class="card-body">
                            <div class="">
                                <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
                            </div>
                             @if(env('RECAPTCHA_MODULE') != 'on')
                               @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <span class="text-danger">{{$error}}</span>
                                    @endforeach
                                @endif
                                @endif
                            <form method="POST" id="form_data" action="{{ route('login') }}">
                            @csrf
                            <div class="">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="emailaddress" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Enter Your Email') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password" placeholder="{{ __('Enter Your Password') }}">
                                </div> 
                                <div class="form-group mb-3 text-start">
                                      <a href="{{ route('password.request', $lang) }}" class=""><small><b>{{ __('Forgot your password?') }}</b></small></a>
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
                                <div class="d-grid">
                                    <button type="submit" id="login_button" class="btn btn-primary btn-block mt-2">{{ __('Login') }}</button>
                                </div>
                               <!--  <p class="my-4 text-center">or register with</p> -->

                                    @if(env('signup_button') == 'on')
                                     <p class="my-4 text-center">Don't have an account? <a href="{{ route('register', $lang) }}" class="my-4 text-center text-primary"> Register</a></p>
                                    @endif
                                    </form>
 
                                      
                                       <!--  <div class="col-6 py-2 text-start">
                                            <button type="button" id="" class="btn btn-primary text-xs btn-block login-deafult"><a href="#" class="" style="color:#fff">{{ __('User Login') }}</a></button>
                                        </div> -->
                                       <div class="d-grid mt-3">
                                            <button type="button" id="" class="btn btn-primary btn-block  "><a href="{{route('client.login', $lang)}}" class="" style="color:#fff"> {{ __('Client Login') }}</a></button>
                                        </div>             
                                  
                                    <div class="row mt-4">   
                                        <div class="">
                                             @section('language-bar')
                                            <a href="#" class="  btn-primary  ">
                                                <select name="language" id="language" class=" btn-primary btn " onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                    @foreach(App\Models\Utility::languages() as $language)
                                                        <option class="login_lang" @if($lang == $language) selected @endif value="{{ route('login',$language) }}">{{Str::upper($language)}}</option>
                                                    @endforeach
                                                </select>
                                            </a>
                                            @endsection
                                        </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 img-card-side">
                        <div class="auth-img-content">
                            <img src="{{ asset('assets/images/auth/img-auth-3.svg')}}" alt="" class="img-fluid">
                            <h3 class="text-white mb-4 mt-5">“Attention is the new currency”</h3>
                            <p class="text-white">The more effortless the writing looks, the more effort the writer
                                actually put into the process.</p>
                        </div>
                    </div>
                </div>
    

@endsection
@push('custom-scripts')

<script src="{{asset('assets/custom/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
$(document).ready(function () {
  $("#form_data").submit(function (e) {
      $("#login_button").attr("disabled", true);
      return true;
  });
});
</script>
@if(env('RECAPTCHA_MODULE') == 'on')
        {!! NoCaptcha::renderJs() !!}
@endif
@endpush
    </x-auth-card>
</x-guest-layout>
<style>
    .login-deafult {
    width: 139px !important;
}
    </style>