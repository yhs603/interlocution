<?php

namespace Interlocution\Services;

trait AjaxReturn
{
    protected $http_code = 200;
    protected $success_code = 200;
    protected $success_msg = '请求成功';
    protected $error_code = 500;
    protected $error_msg = '服务器繁忙，请稍后重试';
    protected $http_header = [];

    /**
     * @return int
     */
    public function getSuccessCode(): int
    {
        return $this->success_code;
    }

    /**
     * @param int $success_code
     *
     * @return $this
     */
    public function setSuccessCode(int $success_code)
    {
        $this->success_code = $success_code;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->error_code;
    }

    /**
     * @param int $error_code
     *
     * @return $this
     */
    public function setErrorCode(int $error_code)
    {
        $this->error_code = $error_code;

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->http_code;
    }

    /**
     * @param int $http_code
     *
     * @return $this
     */
    public function setHttpCode(int $http_code)
    {
        $this->http_code = $http_code;

        return $this;
    }

    /**
     * @return array
     */
    public function getHttpHeader(): array
    {
        return $this->http_header;
    }

    /**
     * @param array $http_header
     *
     * @return $this
     */
    public function setHttpHeader(array $http_header)
    {
        $this->http_header = $http_header;

        return $this;
    }

    /**
     * ajax请求正确返回
     *
     * @param string $msg  返回信息
     * @param array  $data 返回数据
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($msg = '', $data = [])
    {
        $res = [
            'code'    => $this->success_code,
            'message' => empty($msg) ? $this->success_msg : $msg,
            'data'    => $data,
        ];

        return response()->json($res, $this->http_code, $this->http_header);
    }

    /**
     * ajax请求错误返回
     *
     * @param string $msg  返回信息
     * @param array  $data 返回数据
     * @param array  $code 错误码
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($msg = '', $data = [], $code = null)
    {
        $res = [
            'code'    => empty($code) ? $this->error_code : $code,
            'message' => empty($msg) ? $this->error_msg : $msg,
            'data'    => $data,
        ];

        return response()->json($res, $this->http_code, $this->http_header);
    }
}