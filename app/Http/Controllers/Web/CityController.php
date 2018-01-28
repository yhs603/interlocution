<?php

namespace Interlocution\Http\Controllers\Web;

use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\City;

class CityController extends Controller
{
    public function ajaxProvinceList()
    {
        $province_list = City::provinceList();

        return $this->success('', $province_list);
    }

    public function ajaxCityList($pid)
    {
        if (empty($pid)) {
            return $this->error('参数错误');
        }
        $city_list = City::cityList($pid);

        return $this->success('', $city_list);
    }

    public function ajaxDistrictList($pid)
    {
        if (empty($pid)) {
            return $this->error('参数错误');
        }
        $district_list = City::districtList($pid);

        return $this->success('', $district_list);
    }
}
