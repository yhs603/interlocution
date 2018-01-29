<?php

namespace Interlocution\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Interlocution\Models\Record;
use Interlocution\Models\User;
use Interlocution\Models\Setting;
use Interlocution\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Naux\Mail\SendCloudTemplate;
use Ramsey\Uuid\Uuid;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        try {
            $user = User::create([
                'username'           => $data['username'],
                'email'              => $data['email'],
                'password'           => bcrypt($data['password']),
                'confirmation_token' => Uuid::uuid1()->toString()
            ]);

            if ($user) {
                $experience_register = (int)Setting::getCache('experience_register');
                $ladder_register     = (int)Setting::getCache('ladder_register');
                //注册成功后赠送经验值
                Record::records($user, 'register', 0, $experience_register, $ladder_register);

                //添加用户附属信息
                $user->userExtra()->create([
                    'user_id'       => $user->id,
                    'experience'    => $experience_register,
                    'ladder'        => $ladder_register,
                    'registered_at' => Carbon::now(),
                    'last_login_ip' => request()->getClientIp(),
                ]);

                //更新新增用户角色
                $user->roles()->attach(2);

                //注册成功发送激活邮件
                $this->sendVerifyEmailTo($user);
            }
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email'    => 'required|string|email|max:64|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        //注册成功并登录后赠送经验值
        Record::records($user, 'login', 0, (int)Setting::getCache('experience_login'));

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    private function sendVerifyEmailTo($user)
    {
        // 模板变量
        $bind_data = [
            'url'  => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->username,
        ];
        $template  = new SendCloudTemplate('interlocution_register', $bind_data);

        Mail::raw($template, function ($message) use ($user) {
            $message->from(config('interlocution.send_cloud.email'), config('interlocution.send_cloud.name'));

            $message->to($user->email);
        });
    }
}
