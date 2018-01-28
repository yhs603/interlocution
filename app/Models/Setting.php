<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public static function byName($name)
    {
        $settings = self::where('name', $name)->first();
        if ($settings) {
            return $settings->value;
        }

        return '';
    }

    /**
     * 根据name获取对应系统配置项值
     *
     * @param $name
     *
     * @return string
     */
    public static function getCache($name)
    {
        $settings = Cache::rememberForever('settings', function () {
            return self::where('status', 1)->get();
        });

        /*按类文档型返回分类*/
        $value = '';
        foreach ($settings as $val) {
            if ($val->name == $name) {
                $value = $val->value;
                break;
            }
        }

        return $value;
    }
}
