<?php

namespace App\Http\Controllers;

use App\Models\Mail\EmailTest;
use App\Models\Utility;
use App\Models\Workspace;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->type == 'admin') {
            $workspace = new Workspace();
            $payment_detail = Utility::getAdminPaymentSetting();
            $setting = DB::table('admin_payment_settings')->pluck('value', 'name')->toArray();

            return view('setting', compact('workspace', 'payment_detail', 'setting'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function store(Request $request)
    {

 
        $user = Auth::user();
        if ($user->type == 'admin') {
            $dir = 'logo/';
            if ($request->favicon) {
                 $logo_favicon_Name = 'favicon.png';
                // $request->validate(['favicon' => 'required|image|mimes:png|max:204800']);

                $validator = \Validator::make($request->all(), [
                 'favicon' => 'required|image|mimes:png',
           
                  ]);
           if($validator->fails())
          {

            $messages = $validator->getMessageBag();
             
              return redirect()->back()->with('error', "logo image must have  png file.");
          }
            //  $request->validate(['favicon' => 'required|image|mimes:png|max:204800']);

               
                 $path = Utility::upload_file($request,'favicon',$logo_favicon_Name,$dir,[]);
                if($path['flag'] == 1){
                    $favicon = $path['url'];
                }
                else{
                    return redirect()->back()->with('error', __($path['msg']));
                }

            }
            if ($request->logo_blue) {
                $logo_dark_Name = 'logo-light.png';
                // $request->validate(['logo_blue' => 'required|image|mimes:png|max:204800']);

                    $validator = \Validator::make($request->all(), [
                 'logo_blue' => 'required|image|mimes:png',
           
                  ]);
           if($validator->fails())
          {

            $messages = $validator->getMessageBag();
             
              return redirect()->back()->with('error', "logo image must have  png file.");
          }

                $path = Utility::upload_file($request,'logo_blue',$logo_dark_Name,$dir,[]);
                if($path['flag'] == 1){
                    $logo_blue = $path['url'];
                }
                else{
                    return redirect()->back()->with('error', __($path['msg']));
                }


            }
            if ($request->logo_white) {
                $logo_white_Name = 'logo-dark.png';
                // $request->validate(['logo_white' => 'required|image|mimes:png|max:204800']);



         $validator = \Validator::make($request->all(), [
                 'logo_white' => 'required|image|mimes:png',
           
                  ]);
           if($validator->fails())
          {

            $messages = $validator->getMessageBag();
             
              return redirect()->back()->with('error', "logo image must have  png file.");
          }


               $path = Utility::upload_file($request,'logo_white',$logo_white_Name,$dir,[]);
                if($path['flag'] == 1){
                    $logo_white = $path['url'];
                }
                else{
                    return redirect()->back()->with('error', __($path['msg']));
                }

            }

            $rules = [
                'app_name' => 'required|string|max:50',
                'default_language' => 'required|string|max:50',
                'footer_text' => 'required|string|max:50',

            ];

            $request->validate($rules);
            $cookie_text = (!isset($request->cookie_text) && empty($request->cookie_text)) ? '' : $request->cookie_text;
            $arrEnv = [
                'APP_NAME' => $request->app_name,
                'DEFAULT_LANG' => $request->default_language,
                'FOOTER_TEXT' => $request->footer_text,
                'DISPLAY_LANDING' => $request->display_landing ? 'on':'off',
                'SITE_RTL' => $request->site_rtl ?? 'off',
                'gdpr_cookie' => !isset($request->gdpr_cookie) ? 'off' : 'on',
                'cookie_text'=>  $cookie_text,
                'signup_button' => !isset($request->signup_button) ? 'off' : 'on',
            ];
            Utility::setEnvironmentValue($arrEnv);
     
            $color = (!empty($request->theme_color)) ? $request->theme_color : 'theme-3';

            $post['color'] = $color;

            $cust_theme_bg = (!empty($request->cust_theme_bg)) ? 'on' : 'off';
            $post['cust_theme_bg'] = $cust_theme_bg;

            $cust_darklayout = !empty($request->cust_darklayout) ? 'on' : 'off';
            $post['cust_darklayout'] = $cust_darklayout;

           
            if (isset($post) && !empty($post) && count($post) > 0) {
                $created_at = date('Y-m-d H:i:s');
                $updated_at = date('Y-m-d H:i:s');

                foreach ($post as $key => $data) {
                    \DB::insert('insert into admin_payment_settings (`value`, `name`,`created_at`,`updated_at`) values (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`)', [
                        $data,
                        $key,
                        $created_at,
                        $updated_at,
                    ]);
                }
            }

            if ($this->setEnvironmentValue($arrEnv)) {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function emailSettingStore(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'admin') {
            $rules = [
                'mail_driver' => 'required|string|max:50',
                'mail_host' => 'required|string|max:50',
                'mail_port' => 'required|string|max:50',
                'mail_username' => 'required|string|max:50',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:50',
                'mail_from_address' => 'required|string|max:50',
                'mail_from_name' => 'required|string|max:50',
            ];

            $request->validate($rules);

            $arrEnv = [
                
                'MAIL_DRIVER'=>$request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            Utility::setEnvironmentValue($arrEnv);

            // Artisan::call('config:cache');
            // Artisan::call('config:clear');

            // if ($this->setEnvironmentValue($arrEnv)) {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            // } 
            // else {
            //     return redirect()->back()->with('error', __('Something is wrong'));
            // }
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function paymentSettingStore(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'admin') {
            $validate = [
                'currency' => 'required|string|max:50',
                'currency_symbol' => 'required|string|max:50',
            ];

            if (isset($request->is_stripe_enabled) && $request->is_stripe_enabled == 'on') {
                $validate['stripe_key'] = 'required|string';
                $validate['stripe_secret'] = 'required|string';
            }
            if (isset($request->is_paypal_enabled) && $request->is_paypal_enabled == 'on') {
                $validate['paypal_client_id'] = 'required|string';
                $validate['paypal_secret_key'] = 'required|string';
            }
            if (isset($request->is_paystack_enabled) && $request->is_paystack_enabled == 'on') {
                $validate['paystack_public_key'] = 'required|string';
                $validate['paystack_secret_key'] = 'required|string';
            }
            if (isset($request->is_flutterwave_enabled) && $request->is_flutterwave_enabled == 'on') {
                $validate['flutterwave_public_key'] = 'required|string';
                $validate['flutterwave_secret_key'] = 'required|string';
            }
            if (isset($request->is_razorpay_enabled) && $request->is_razorpay_enabled == 'on') {
                $validate['razorpay_public_key'] = 'required|string';
                $validate['razorpay_secret_key'] = 'required|string';
            }
            if (isset($request->is_mercado_enabled) && $request->is_mercado_enabled == 'on') {
                $validate['mercado_access_token'] = 'required|string';
                $validate['mercado_mode'] = 'required|string';
            }
            if (isset($request->is_paytm_enabled) && $request->is_paytm_enabled == 'on') {
                $validate['paytm_mode'] = 'required|string';
                $validate['paytm_merchant_id'] = 'required|string';
                $validate['paytm_merchant_key'] = 'required|string';
                $validate['paytm_industry_type'] = 'required|string';
            }
            if (isset($request->is_mollie_enabled) && $request->is_mollie_enabled == 'on') {
                $validate['mollie_api_key'] = 'required|string';
                $validate['mollie_profile_id'] = 'required|string';
                $validate['mollie_partner_id'] = 'required|string';
            }
            if (isset($request->is_skrill_enabled) && $request->is_skrill_enabled == 'on') {
                $validate['skrill_email'] = 'required|email';
            }
            if (isset($request->is_coingate_enabled) && $request->is_coingate_enabled == 'on') {
                $validate['coingate_mode'] = 'required|string';
                $validate['coingate_auth_token'] = 'required|string';
            }

            if (isset($request->is_paymentwall_enabled) && $request->is_paymentwall_enabled == 'on') {
                $validate['paymentwall_public_key'] = 'required|string';
                $validate['paymentwall_private_key'] = 'required|string';
            }

            $validator = Validator::make(
                $request->all(), $validate
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $arrEnv = [
                'CURRENCY' => $request->currency,
                'CURRENCY_SYMBOL' => $request->currency_symbol,
            ];


            $this->setEnvironmentValue($arrEnv);


            if (isset($request->is_stripe_enabled) && $request->is_stripe_enabled == 'on') {
                $post['is_stripe_enabled'] = $request->is_stripe_enabled;
                $post['stripe_key'] = $request->stripe_key;
                $post['stripe_secret'] = $request->stripe_secret;
               // $post['stripe_webhook_secret'] = $request->stripe_webhook_secret;
            } else {
                $post['is_stripe_enabled'] = 'off';
            }

            // Save Paypal Detail
            if (isset($request->is_paypal_enabled) && $request->is_paypal_enabled == 'on') {
                $post['is_paypal_enabled'] = $request->is_paypal_enabled;
                $post['paypal_mode'] = $request->paypal_mode;
                $post['paypal_client_id'] = $request->paypal_client_id;
                $post['paypal_secret_key'] = $request->paypal_secret_key;
            } else {
                $post['is_paypal_enabled'] = 'off';
            }

            // Save Paystack Detail
            if (isset($request->is_paystack_enabled) && $request->is_paystack_enabled == 'on') {
                $post['is_paystack_enabled'] = $request->is_paystack_enabled;
                $post['paystack_public_key'] = $request->paystack_public_key;
                $post['paystack_secret_key'] = $request->paystack_secret_key;
            } else {
                $post['is_paystack_enabled'] = 'off';
            }

            // Save Fluuterwave Detail
            if (isset($request->is_flutterwave_enabled) && $request->is_flutterwave_enabled == 'on') {
                $post['is_flutterwave_enabled'] = $request->is_flutterwave_enabled;
                $post['flutterwave_public_key'] = $request->flutterwave_public_key;
                $post['flutterwave_secret_key'] = $request->flutterwave_secret_key;
            } else {
                $post['is_flutterwave_enabled'] = 'off';
            }

            // Save Razorpay Detail
            if (isset($request->is_razorpay_enabled) && $request->is_razorpay_enabled == 'on') {
                $post['is_razorpay_enabled'] = $request->is_razorpay_enabled;
                $post['razorpay_public_key'] = $request->razorpay_public_key;
                $post['razorpay_secret_key'] = $request->razorpay_secret_key;
            } else {
                $post['is_razorpay_enabled'] = 'off';
            }

            if (isset($request->is_mercado_enabled) && $request->is_mercado_enabled == 'on') {
                $request->validate(
                    [
                        'mercado_access_token' => 'required|string',
                    ]
                );
                $post['is_mercado_enabled'] = $request->is_mercado_enabled;
                $post['mercado_access_token'] = $request->mercado_access_token;
                $post['mercado_mode'] = $request->mercado_mode;
            } else {
                $post['is_mercado_enabled'] = 'off';
            }

            // Save Paytm Detail
            if (isset($request->is_paytm_enabled) && $request->is_paytm_enabled == 'on') {
                $post['is_paytm_enabled'] = $request->is_paytm_enabled;
                $post['paytm_mode'] = $request->paytm_mode;
                $post['paytm_merchant_id'] = $request->paytm_merchant_id;
                $post['paytm_merchant_key'] = $request->paytm_merchant_key;
                $post['paytm_industry_type'] = $request->paytm_industry_type;
            } else {
                $post['is_paytm_enabled'] = 'off';
            }

            // Save Mollie Detail
            if (isset($request->is_mollie_enabled) && $request->is_mollie_enabled == 'on') {
                $post['is_mollie_enabled'] = $request->is_mollie_enabled;
                $post['mollie_api_key'] = $request->mollie_api_key;
                $post['mollie_profile_id'] = $request->mollie_profile_id;
                $post['mollie_partner_id'] = $request->mollie_partner_id;
            } else {
                $post['is_mollie_enabled'] = 'off';
            }

            // Save Skrill Detail
            if (isset($request->is_skrill_enabled) && $request->is_skrill_enabled == 'on') {
                $post['is_skrill_enabled'] = $request->is_skrill_enabled;
                $post['skrill_email'] = $request->skrill_email;
            } else {
                $post['is_skrill_enabled'] = 'off';
            }

            // Save Coingate Detail
            if (isset($request->is_coingate_enabled) && $request->is_coingate_enabled == 'on') {
                $post['is_coingate_enabled'] = $request->is_coingate_enabled;
                $post['coingate_mode'] = $request->coingate_mode;
                $post['coingate_auth_token'] = $request->coingate_auth_token;
            } else {
                $post['is_coingate_enabled'] = 'off';
            }

            if (isset($request->is_paymentwall_enabled) && $request->is_paymentwall_enabled == 'on') {

                $post['is_paymentwall_enabled'] = $request->is_paymentwall_enabled;
                $post['paymentwall_public_key'] = $request->paymentwall_public_key;
                $post['paymentwall_private_key'] = $request->paymentwall_private_key;
            } else {
                $post['is_paymentwall_enabled'] = 'off';
            }

            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
           
            foreach ($post as $key => $data) {
                \DB::insert('insert into admin_payment_settings (`value`, `name`,`created_at`,`updated_at`) values (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`)', [
                    $data,
                    $key,
                    $created_at,
                    $updated_at,
                ]);
            }

            // Artisan::call('config:cache');
            // Artisan::call('config:clear');
            return redirect()->back()->with('success', __('Payment Setting updated successfully'));

        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function pusherSettingStore(Request $request)
    {

        $user = Auth::user();
        if ($user->type == 'admin') {
            $rules = [];

            if ($request->enable_chat == 'on') {
                $rules['pusher_app_id'] = 'required|string|max:50';
                $rules['pusher_app_key'] = 'required|string|max:50';
                $rules['pusher_app_secret'] = 'required|string|max:50';
                $rules['pusher_app_cluster'] = 'required|string|max:50';
            }

            $request->validate($rules);

            $arrEnv = [
                'CHAT_MODULE' => $request->enable_chat,
                'PUSHER_APP_ID' => $request->pusher_app_id,
                'PUSHER_APP_KEY' => $request->pusher_app_key,
                'PUSHER_APP_SECRET' => $request->pusher_app_secret,
                'PUSHER_APP_CLUSTER' => $request->pusher_app_cluster,
            ];

            // Artisan::call('config:cache');
            // Artisan::call('config:clear');

            if ($this->setEnvironmentValue($arrEnv)) {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) 
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                } 
                else 
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";

        // Artisan::call('config:cache');
        // Artisan::call('config:clear');

        return file_put_contents($envFile, $str) ? true : false;

    }

    public function testEmail(Request $request)
    {

        $user = Auth::user();

        if ($user->type == 'admin') {
            $data = [];
            $data['mail_driver'] = !($request->mail_driver) ? env('MAIL_DRIVER') : $request->mail_driver;
            $data['mail_host'] = !($request->mail_host) ? env('MAIL_HOST') : $request->mail_host;
            $data['mail_port'] = !($request->mail_port) ? env('MAIL_PORT') : $request->mail_port;
            $data['mail_username'] = !($request->mail_username) ? env('MAIL_USERNAME') : $request->mail_username;
            $data['mail_password'] = !($request->mail_password) ? env('MAIL_PASSWORD') : $request->mail_password;
            $data['mail_encryption'] = !($request->mail_encryption) ? env('MAIL_ENCRYPTION') : $request->mail_encryption;
            $data['mail_from_address'] = !($request->mail_from_address) ? env('MAIL_FROM_ADDRESS') : $request->mail_from_address;
            $data['mail_from_name'] = !($request->mail_from_name) ? env('MAIL_FROM_NAME') : $request->mail_from_name;

            return view('users.test_email', compact('data'));
        } else {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function testEmailSend(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try
        {
        config([
            'mail.driver' => $request->mail_driver,
            'mail.host' => $request->mail_host,
            'mail.port' => $request->mail_port,
            'mail.encryption' => $request->mail_encryption,
            'mail.username' => $request->mail_username,
            'mail.password' => $request->mail_password,
            'mail.from.address' => $request->mail_from_address,
            'mail.from.name' => $request->mail_from_name,
        ]);

        Mail::to($request->email)->send(new EmailTest());

        }
        catch(\Exception $e)
        {
            return response()->json([
                                        'is_success' => false,
                                        'message' => $e->getMessage(),
                                    ]);
        }

        return response()->json([
            'is_success' => true,
            'message' => __('Email send Successfully'),
        ]);
    }
    public function recaptchaSettingStore(Request $request)
    {
        

        $user = \Auth::user();
        $rules = [];

        if ($request->recaptcha_module == 'on') {
            $rules['google_recaptcha_key'] = 'required|string|max:50';
            $rules['google_recaptcha_secret'] = 'required|string|max:50';
        }

        $validator = \Validator::make(
            $request->all(), $rules
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $arrEnv = [
            'RECAPTCHA_MODULE' => $request->recaptcha_module ? 'on':'off',       
            'NOCAPTCHA_SITEKEY' => $request->google_recaptcha_key,
            'NOCAPTCHA_SECRET' => $request->google_recaptcha_secret,
        ];

        if ($this->setEnvironmentValue($arrEnv)) {
            return redirect()->back()->with('success', __('Recaptcha Settings updated successfully'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }


    public function storageSettingStore(Request $request)
    {
        
        if(isset($request->storage_setting) && $request->storage_setting == 'local')
        {
           
            $request->validate(
                [
                   
                    'local_storage_validation' => 'required',
                    'local_storage_max_upload_size' => 'required',
                ]
            );
            
            $post['storage_setting'] = $request->storage_setting;
            $local_storage_validation = implode(',', $request->local_storage_validation);
            $post['local_storage_validation'] = $local_storage_validation;
            $post['local_storage_max_upload_size'] = $request->local_storage_max_upload_size;
            
        }
        
        if(isset($request->storage_setting) && $request->storage_setting == 's3')
        {
            $request->validate(
                [
                    's3_key'                  => 'required',
                    's3_secret'               => 'required',
                    's3_region'               => 'required',
                    's3_bucket'               => 'required',
                    's3_url'                  => 'required',
                    's3_endpoint'             => 'required',
                    's3_max_upload_size'      => 'required',
                    's3_storage_validation'   => 'required',
                ]
            );
            $post['storage_setting']            = $request->storage_setting;
            $post['s3_key']                     = $request->s3_key;
            $post['s3_secret']                  = $request->s3_secret;
            $post['s3_region']                  = $request->s3_region;
            $post['s3_bucket']                  = $request->s3_bucket;
            $post['s3_url']                     = $request->s3_url;
            $post['s3_endpoint']                = $request->s3_endpoint;
            $post['s3_max_upload_size']         = $request->s3_max_upload_size;
            $s3_storage_validation              = implode(',', $request->s3_storage_validation);
            $post['s3_storage_validation']      = $s3_storage_validation;
        }
        
        if(isset($request->storage_setting) && $request->storage_setting == 'wasabi')
        {
            $request->validate(
                [
                    'wasabi_key'                    => 'required',
                    'wasabi_secret'                 => 'required',
                    'wasabi_region'                 => 'required',
                    'wasabi_bucket'                 => 'required',
                    'wasabi_url'                    => 'required',
                    'wasabi_root'                   => 'required',
                    'wasabi_max_upload_size'        => 'required',
                    'wasabi_storage_validation'     => 'required',
                ]
            );
            $post['storage_setting']            = $request->storage_setting;
            $post['wasabi_key']                 = $request->wasabi_key;
            $post['wasabi_secret']              = $request->wasabi_secret;
            $post['wasabi_region']              = $request->wasabi_region;
            $post['wasabi_bucket']              = $request->wasabi_bucket;
            $post['wasabi_url']                 = $request->wasabi_url;
            $post['wasabi_root']                = $request->wasabi_root;
            $post['wasabi_max_upload_size']     = $request->wasabi_max_upload_size;
            $wasabi_storage_validation          = implode(',', $request->wasabi_storage_validation);
            $post['wasabi_storage_validation']  = $wasabi_storage_validation;
        }
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        foreach($post as $key => $data)
        {

            $arr = [
                $data,
                $key,
                $created_at,
                $updated_at,
              
            ];

            
            \DB::insert(
                'insert into admin_payment_settings (`value`, `name`,`created_at`,`updated_at`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', $arr
            );
        }
        
        return redirect()->back()->with('success', 'Storage setting successfully updated.');
        
    }
    

}

