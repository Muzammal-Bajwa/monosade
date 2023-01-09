<x-guest-layout>
    <x-auth-card>

@section('page-title') {{__('Register')}} @endsection

@section('content')

<section id="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-6 flush">
                        <div class="content_side">
                            <a class="logo" href="#"><img src="{{ asset('public/new_assets/assets/img/logo_main.png')}}"/></a>
                            <h1>Create an<br/>
                                <span>Account</span></h1>
                            <p>Let’s get started...</p>
                            <form method="POST" action="{{ route('register') }}">
                               @csrf
                                <div class="form-group mearge side_by">
                                    
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="first_br"  value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Enter Your Name') }}">
                                     @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="text" class="form-control  @error('workspace_name') is-invalid @enderror" name="workspace" id="exampleInputEmail1" value="{{ old('workspace') }}" required autocomplete="workspace"  placeholder="{{ __('Enter Your Workspace Name') }}">
                                       @error('company')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group mearge no_rd">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Enter Your Email') }}">
                                       @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="exampleInputEmail1" placeholder="{{ __('Enter Your Password') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" id="exampleInputPassword1" placeholder="{{ __('Confirm Your Password') }}">

                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">I accept terms & condition</label>
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
                                    <button type="submit" class="btn btn-primary ca_btn">CREATE ACCOUNT</button>
                                    <a href="{{route('login', $lang)}}" class="sign_up_btn">LOGIN</a>
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
    </x-auth-card>
</x-guest-layout>
