<?php

namespace Interlocution\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use Interlocution\Services\AjaxReturn;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AjaxReturn;

    protected $page_size;

    public function __construct()
    {
        $this->page_size = config('interlocution.page_size');
    }

    /**
     * 缓存计数器
     *
     * @param      $key     键
     * @param null $value   增量
     * @param int  $minutes 有效时间,单位:分
     *
     * @return null
     */
    public function cacheCounter($key, $value = NULL, $minutes = 60)
    {
        /*计数从1开始*/
        $count = Cache::get($key, 1);
        /*直接获取值*/
        if ($value === NULL) {
            return $count;
        }
        $count += $value;
        Cache::has($key) ? Cache::increment($key, $value) : Cache::put($key, $count, $minutes);

        return $count;
    }
}
