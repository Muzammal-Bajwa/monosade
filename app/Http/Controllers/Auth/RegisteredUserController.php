<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workspace;
use App\Models\UserWorkspace;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */


      public function __construct()
    {
        $this->middleware('guest');
    }


    public function create()
    {
        // return view('auth.register');
    }



  public function showRegistrationForm($lang = '')
    {
        if ($lang == '') {
            $lang = env('DEFAULT_LANG') ?? 'en';
        }

        \App::setLocale($lang);
        // if(env('signup_button') == 'on'){
        //     return view('auth.register', compact('lang'));
        // }else{
        //     return abort('404', 'Page not found');
        // }
        return view('auth.register', compact('lang'));
    }

    public function store(Request $request)
    {
        if(env('RECAPTCHA_MODULE') == 'on')
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }else{
            $validation = [];
        }
        $this->validate($request, $validation);
        $request->validate([
            'name' => 'required|string|max:255',
            'workspace' => 'required', 'string', 'max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
             'workspace'=>$request->workspace,
            'password' => Hash::make($request->password),
            'plan'=>1,
        ]);
         
         $objWorkspace = Workspace::create(['created_by'=>$user->id,'name'=>$request->workspace, 'currency_code' => 'USD', 'paypal_mode' => 'sandbox']);

         
        $user->currant_workspace = $objWorkspace->id;
         $user->save();
        
        event(new Registered($user));

        Auth::login($user);
        UserWorkspace::create(['user_id'=> $user->id,'workspace_id'=>$objWorkspace->id,'permission'=>'Owner']);
        
        return redirect(RouteServiceProvider::HOME);
    }
}



   