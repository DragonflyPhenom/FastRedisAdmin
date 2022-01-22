<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Services\RedisAdmin\RedisAdmin as RedisHelper;

require base_path().'/vendor/autoload.php';

/**
 * Пересобирает карту сайта, проверяя 404
 * Class Sitemap
 * @package App\Http\Controllers
 */
class RedisAdmin extends Controller
{
    /**
     * Получает все ключи редиса
     */
    public function getKeysList():object
    {
        ini_set('memory_limit', '-1');
        $all = Redis::keys('*');
        $ar = [];
        foreach ($all as $k => $a) {
            unset($all[$k]);
            $d = explode(':',$a);

            //Здесь можно было бы использовать array_merge_recursive, но отрабатывает дольше, чем кастомная рекурсия
            $ar = RedisHelper::arrayRecursive($ar,$d,$a);
        }
        return view('redisAdmin.main', ['arKeys' => $ar]);
    }

    /**
     * Получает значение конкретного ключа
     * @param Request $request
     * @return string
     */
    public function getKeyValue(Request $request):string
    {
        $value = Redis::get($request->get('KEY'));
        if (@unserialize($value)) $value = unserialize($value);
        return print_r($value);
    }

    /**
     * Удаляет конкретный ключ
     * @param Request $request
     */
    public function deleteKey(Request $request):void
    {
        $key = str_replace('-key','',$request->get('KEY'));
        Redis::del($key);
    }
}