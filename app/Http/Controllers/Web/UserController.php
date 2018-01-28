<?php

namespace Interlocution\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\User;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    /**
     * 邮箱激活验证
     *
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if (!$user) {
            return abort(403, 'token无效');
        }

        $user->status             = 1;
        $user->confirmation_token = Uuid::uuid1()->toString();
        $user->save();

        Auth::login($user);

        return redirect(route('home'));
    }
}
