<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/4
 * Time: 10:04
 */

namespace App\Http\base\controller;

use app\Http\base\logic\Result;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected function build($result = 0, $message = 'success', $data = [])
    {
        $a = '';
        switch (true) {
            case $result instanceof Result:
                // For Result类，适用于直接返回Logic的Result
                $response = [
                    'error' => $result->code,
                    'message' => $result->message
                ];
                $data = $result->data;
                break;
            case is_array($result):
                // For Array，适用于成功的时候返回对应的数据
                $response = [
                    'error' => 0,
                    'message' => $message
                ];
                $data = $result;
                break;
            default:
                // 一般来说，只有报错的时候需要填写全部参数; 此时 $data 为参数传入的 $data, 保持不变
                $response = [
                    'error' => $result,
                    'message' => $message
                ];
        }

        if (!empty($data)) {

            $response['data'] = $data;
        }

        if (is_object($data) && !empty($data->data)) {

            $response['data'] = $data->data;

        }

//        //如果报错的话，打印跟踪日志
//        if ($response['error'] !== 0) {
//            trace($response, 'error');
//        }

        return $response;
    }

    /**
     * 构造返回数据
     * exam: build($result);
     * exam: build(['data1'=>[],'data2'=>[]]);
     * @param int | array |  $result
     * @param string $message
     * @param array $data
     * @return array
     */

    private function buildWithMerge($result = 0, $message = 'success', $data = [])
    {

        $resp = $this->build($result, $message, $data);

        $response = [
            'error' => $resp['error'],
            'message' => $resp['message'],
        ];

        //合并Data数据到Response
        if (!empty($resp['data'])) {
            $response = array_merge($response, $resp['data']);

        }

        return $response;
    }

    /**
     * @param int $result
     * @param string $message
     * @param array $data
     * @return array
     */
    protected function response($result = 0, $message = 'success', $data = [])
    {

        return $this->json($result, $message, $data);
    }

    protected function json($result = 0, $message = 'success', $data = [])
    {
        return ($this->buildWithMerge($result, $message, $data));
    }

}