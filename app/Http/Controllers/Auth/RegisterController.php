<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['showRegisterEmailVerification', 'registerEmailVerification', 'sendRegisterEmailVerification']]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'img' => $user->gravatar($data['email'], '140'),
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 重写redirectPath()方法，添加根据session内url跳转上一次页面功能
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public function redirectPath()
    {
        if (session()->has('re_lo_url')) {
            //dd(session('re_lo_url'));
            return session('re_lo_url');
        }
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }


    public function showRegisterEmailVerification()
    {
        return view('auth.registerEmailVerification', ['show' => 1]);
    }

    public function sendRegisterEmailVerification()
    {
        $user = \Auth::user();
        if(!$user->verified){
            $user->sendRegisterNotification($user);
        }
        return back()->with('status', '发送成功');
    }

    public function registerEmailVerification($verification)
    {

        $user = User::query()->where('verification_token', $verification)->first();
        if ($user) {
            $user->verified = true;
            $user->save();
            \Auth::login($user);
        }
        return view('auth.registerEmailVerification');
    }
}
