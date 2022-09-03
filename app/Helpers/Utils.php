<?php

namespace App\Helpers;

/**
 * General Method
 */
class Utils
{
    /**
     * Micro Second Time
     *
     * @return $microSecTime
     */
    public static function microSecTime()
    {
        list($microSec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($microSec) + floatval($sec)) * 1000);
    }

    /**
     * Validate Url
     */
    public static function isUrl($str)
    {
        $pattern = "#(http|https)://(.*\.)?.*\..*#i";
        if (preg_match($pattern, $str)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get Currrent Server Host IP
     *
     * @return string
     */
    public static function getServerIp()
    {
        if (isset($_SERVER['SERVER_NAME'])) {
            return gethostbyname($_SERVER['SERVER_NAME']);
        } else {
            if (isset($_SERVER)) {
                $server_ip = $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? '';
            } else {
                $server_ip = getenv('SERVER_ADDR') ?? '';
            }
        }
        return $server_ip ?? '';
    }

    /**
     * Get Client IP
     *
     * @return string
     */
    public static function getClientIp()
    {
        if (isset($_SERVER)) {
            $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
        } else {
            $client_ip = getenv('HTTP_X_FORWARDED_FOR') ?? getenv('HTTP_CLIENT_IP') ?? getenv('REMOTE_ADDR') ?? '';
        }
        return $client_ip ?? '';
    }

    /**
     * Running Time
     * @return string
     */
    public static function runTime()
    {
        $time = number_format(microtime(true) - request()->server('REQUEST_TIME_FLOAT'), 2);
        return $time . ' s';
    }

    /**
     * Running Memory
     * @return string
     */
    public static function runMemory()
    {
        $size = memory_get_usage(true);
        $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
        $memory = round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
        return $memory;
    }

    /*
     * Create A Randon String
     */
    public static function createRandomString($len, $chars = null)
    {
        if (is_null($chars)) {
            $chars = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        }
        mt_srand(10000000 * (double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }
}
