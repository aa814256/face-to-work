<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/5
 * Time: 16:24
 */
namespace App\Http\base\logic;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class BaseLogic
{
    /**
     * success
     * @param array $data
     * @return mixed
     */
    protected static function success($data = [])
    {
        if ($data instanceof Model || $data instanceof Paginator) {
            $data = $data->toArray();
        }
        return Result::success($data);
    }

    /**
     * @param string $message
     * @param int $code
     * @param array $data
     * @return mixed
     */
    protected static function error($message = '', $code = 1, $data = [])
    {
        return Result::error($message, $code, $data);
    }
}