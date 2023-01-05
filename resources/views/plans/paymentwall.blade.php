  @php
    $logo=asset(Storage::url('uploads/logo'));
    $company_favicon=Utility::getValByName('company_favicon');
  @endphp
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(Auth::user()->type == 'admin')
      <link rel="icon" href="{{$logo.'/favicon.png'}}" type="image" sizes="16x16">
    @else
      <link rel="icon" href="{{(isset($company_favicon) && !empty($company_favicon)?asset(Storage::url($company_favicon)):'favicon.png')}}" type="image" sizes="16x16">
   @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <script src="https://api.paymentwall.com/brick/build/brick-default.1.5.0.min.js"> </script>
  <div id="payment-form-container"> </div>
  <script>
    var brick = new Brick({
      public_key: '{{ $admin_payment_setting['paymentwall_public_key']  }}', // please update it to Brick live key before launch your project
      amount: {{$plandatas["price"]}},
      currency: '{{ env("CURRENCY")  }}',
      container: 'payment-form-container',
      action: '{{route("plan.pay.with.paymentwall",[$data["plan_id"],$data["coupon"]])}}',
      success_url: '{{route("plans.index")}}',
      form: {
        merchant: 'Paymentwall',
        product:  '{{$plandatas["name"]}}',
        pay_button: 'Pay',
        show_zip: true, // show zip code 
        show_cardholder: true // show card holder name 
      }
    });

     brick.showPaymentForm(function(data) {
        if(errors.flag == 1){
        window.location.href ='{{route("callback.error",1)}}';
        }else{
          window.location.href ='{{route("callback.error",2)}}';
        }
    }, function(errors) {
        if(errors.flag == 1){
        window.location.href ='{{route("callback.error",1)}}';
        }else{
          window.location.href ='{{route("callback.error",2)}}';
        }
    });
    
  </script>