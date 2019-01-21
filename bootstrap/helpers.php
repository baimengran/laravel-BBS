<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 0:43
 */

/**
 * 返回路径名称供页面class使用
 * @return string 路由名称字符串
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 截取字符串
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

/**
 * 截取字符串长度
 * @param string $string 要截取的字符串
 * @param integer $sublen 长度
 * @param int $start 截取字符串起始位置，默认0
 * @param string $code 字符编码
 * @return string 截取后字符串
 */
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
//    if(){
//
//    }
    if ($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if (count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . ".....";
        return join('', array_slice($t_string[0], $start, $sublen));
    } else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';
        for ($i = 0; $i < $strlen; $i++) {
            if ($i >= $start && $i < ($start + $sublen)) {
                if (ord(substr($string, $i, 1)) > 129) {
                    $tmpstr.= substr($string, $i, 2);
                } else {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if (ord(substr($string, $i, 1)) > 129) $i++;
        }
        if (strlen($tmpstr) < $strlen) $tmpstr.= "";
        return $tmpstr;
    }
}