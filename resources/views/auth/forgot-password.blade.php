<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('public/new_assets/assets/css/main_style.css')}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Monoshade | Welcome</title>
</head>
<body class="gray_bg">
    <div class="tableRow">
        <div class="tableCell">
            <section id="otp_verify">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-sm-12 flush text-center">
                            <a href="login.html" class="logo"><img src="{{ asset('public/new_assets/assets/img/logo_main.png')}}" alt="" /></a>
                            <div class="card_wrapper">
                                <div class="card">
                                    <h1>
                                        Forgot<br />
                                        <span>Password</span>
                                    </h1>
                                    <br/>
                                    <form method="POST" action="{{ route('password.email') }}">
                                      @csrf
                                        <div class="form-group">
                                            <!-- <input type="email" name="" id="" placeholder="Enter your email-address" /> -->
                                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="emailaddress" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Enter Your Email') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit">Forgot password</button>
                                        </div>
                                    </form>
                                    <p class="small">Want to go back? <a href="{{ route('login', $lang) }}">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>    

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>