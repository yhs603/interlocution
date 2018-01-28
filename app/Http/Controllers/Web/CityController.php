<?php

namespace Interlocution\Http\Controllers\Web;

use Illuminate\Http\Request;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\City;

class CityController extends Controller
{
    public function ajaxProvinceList()
    {
        City::where('level', 1)->select('code', 'name')->get();
    }

    public function ajaxCityList($pid)
    {
        if (!empty($pid)) {
            return $this->error('参数错误');
        }
        $city_list = City::where('level', 2)->where('pid',$pid)->select('code', 'name')->get();

        return $this->success('', $city_list);
    }

    public function ajaxDistrictList($pid)
    {
        if (!empty($pid)) {
            return $this->error('参数错误');
        }
        $district_list = City::where('level', 3)->where('pid',$pid)->select('code', 'name')->get();

        return $this->success('', $district_list);
    }
}
