<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class City extends Model
{
    public static function provinceList()
    {
        $province_list = Cache::rememberForever('province_list', function () {
            return self::where('level_type', 1)->select('code', 'name')->get();
        });

        return $province_list;
    }


    public static function cityList($pid)
    {
        $all_city_list = Cache::rememberForever('city_list', function () {
            return self::where('level_type', 2)->select('code', 'name')->get();
        });

        $city_list = [];
        foreach ($all_city_list as $city) {
            if ($city->pid == $pid) {
                $city_list[] = $city;
            }
        }

        return $city_list;
    }

    public static function districtList($pid)
    {
        $all_district_list = Cache::rememberForever('district_list', function () {
            return self::where('level_type', 3)->select('code', 'name')->get();
        });

        $district_list = [];
        foreach ($all_district_list as $district) {
            if ($district->pid == $pid) {
                $district_list[] = $district;
            }
        }

        return $district_list;
    }
}
