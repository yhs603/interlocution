<?php

namespace Interlocution\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Record extends Model
{
    protected $fillable = ['user_id', 'action', 'ladder', 'experience'];
    public $timestamps = FALSE;

    /**
     * 记录用户获取经验值、天梯分
     *
     * @param        $user       用户对象
     * @param string $action     执行相关操作：登录、注册、提问、回答问题等
     * @param int    $ladder     天梯分
     * @param int    $experience 经验值
     *
     * @return bool           操作成功返回true 否则  false
     */
    public static function records($user, $action, $ladder = 0, $experience = 0)
    {
        try {
            if ($action == 'login') {
                /*用户每天登陆只添加一次经验值*/
                $is_login = self::where('user_id', $user->id)
                    ->where('action', $action)
                    ->where('created_at', '>', Carbon::today())
                    ->count();
                if ($is_login > 0)
                    throw new \Exception('用户' . $user->id . '已记录');
            }
            /*记录详情数据*/
            self::create([
                'user_id'    => $user->id,
                'action'     => $action,
                'ladder'     => $ladder,
                'experience' => $experience,
                'created_at' => Carbon::now()
            ]);

            /*修改用户账户信息*/
            if ($ladder > 0)
                $user->userExtra()->increment('ladder', $ladder);
            if ($experience > 0)
                $user->userExtra()->increment('experience', $experience);

            return TRUE;
        } catch (\Exception $e) {
            Log::notice($e->getMessage());

            return FALSE;
        }
    }
}
