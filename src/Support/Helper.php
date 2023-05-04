<?php
/**
 * 响应错误
 * @param int $status 状态码
 * @param string $message 错误消息
 * @param array $attache 附加消息
 */
function error(int $status = 1001, string $message = 'error', array $attache = [], $data = [])
{
    header("Content-type:application/json;charset=utf-8");
    $res = json_encode(array('status' => $status, 'message' => $message, 'data' => $data, 'attache' => $attache, 'token' => session('token', '')), JSON_UNESCAPED_UNICODE);
    exit($res);
}

/**
 * 正常响应接口
 * @param array $data 接口返回数据
 * @param string $message 消息
 * @param array $attache 附加数据
 */
function success($data = [], string $message = 'ok', array $attache = [])
{
    header("Content-type:application/json;charset=utf-8");
    $res = json_encode(array('status' => 0, 'message' => $message, 'data' => $data, 'attache' => $attache, 'token' => session('token', '')), JSON_UNESCAPED_UNICODE);
    exit($res);
}
