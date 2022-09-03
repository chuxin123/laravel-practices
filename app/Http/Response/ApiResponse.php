<?php

namespace App\Http\Response;

class ApiResponse
{
    /**
     *  Success response
     *
     * @param int    $status
     * @param string $message
     * @param array  $data
     *
     * @return json
     */
    public static function success(int $status = 0, string $message = '成功', array $data = null)
    {
        return self::merge('true', $status, $message, $data);
    }

    /**
     * Fail response
     *
     * @param int    $status
     * @param string $message
     * @param array  $data
     *
     * @return json
     */
    public static function fail(int $status = -1, string $message = '失败', array $data = null)
    {
        return self::merge('false', $status, $message, $data);
    }

    /**
     *
     * @param string $success
     * @param int    $status
     * @param string $message
     * @param array  $data
     *
     * @return json
     */
    private static function merge(string $success, int $status, string $message, array $data = null)
    {
        $response = ['success' => $success, 'status' => $status, 'message' => $message, 'data' => $data, 'timestamp' => time(), 'errorInfo' => null, 'errorMessage' => ''];

        return response()->json($response, 200, ['Content-Type' => 'application/json', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Pagination response
     *
     * @param array $list
     * @param int   $count
     * @param int   $pageIndex
     * @param int   $pageSize
     *
     * @return array
     */
    public static function page_result(array $list = null, int $count = 0, int $pageIndex = 1, int $pageSize = 20)
    {
        if ($count) {
            return ['count' => $count, 'pageCount' => ceil($count / $pageSize), 'pageNow' => $pageIndex, 'pageIndex' => $pageIndex, 'pageSize' => $pageSize, 'list' => $list];
        } else {
            return null;
        }
    }
}
