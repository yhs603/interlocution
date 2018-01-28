<?php
/**
 * 时间戳格式化
 *
 * @param int $time
 *
 * @return string 完整的时间显示
 * @author huajie <banhuajie@163.com>
 */
if (!function_exists('time_format')) {
    function time_format($time = NULL, $format = 'Y-m-d')
    {
        $time = $time === NULL ? time() : intval($time);

        return date($format, $time);
    }
}