<?php
namespace App\Services\RedisAdmin;

/**
 * Created by PhpStorm.
 * User: Alec1
 * Date: 22.01.2022
 * Time: 13:19
 */
class RedisAdmin
{
    /**
     * Рекурсивно собирает ключи редиса в один массив
     * @param $array array
     * @param $data array
     * @param $val string
     * @return mixed
     */
    public static function arrayRecursive(array &$array,array $data,string $val):array
    {
        if (!array_key_exists($data[0],$array) && count($data) == 1) {
            $array[$data[0]] = $val;
        }
        if (!array_key_exists($data[0],$array) && count($data) > 1) {
            $k = $data[0];
            $array[$k] = [];
            array_shift($data);
            self::arrayRecursive($array[$k],$data,$val);
        }
        if (array_key_exists($data[0],$array) && count($data) > 1) {
            $k = $data[0];
            array_shift($data);
            self::arrayRecursive($array[$k],$data,$val);
        }
        return $array;
    }
}