<?php

namespace App\Logging;

use Psr\Log\LoggerInterface;

class CustomLogger implements LoggerInterface
{

    /**
     * aliyun log config
     * @var
     */
    private $config;

    /**
     * default topic
     * @var
     */
    private $topic;

    private $endPoint;

    private $accessKeyId;

    private $accessKey;

    private $project;

    private $logStore;

    private $client;

    private $request;

    private static $initConfigFlag;


    public function emergency($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function alert($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function critical($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function error($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function warning($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function notice($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function info($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function debug($message, array $context = array()): void
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }


    public function log($level, $message, array $context = array()): void
    {
        $this->writeLog($level, $message, $context);
    }

    /**
     * write log
     *
     * @param string $data log content
     */
    public function write(string $level, string $message, array $context)
    {
        $log_path = base_path('storage/logs/');
        $destination = $log_path . '/' . date('Ym') . '/' . date('d') . '.log';
        $path = dirname($destination);
        !is_dir($path) && mkdir($path, 0755, true);
        error_log(date('H:i:s') . ': [level:' . $level . '][message:' . $message . ']' . json_encode($context) . "\r\n", 3, $destination);
    }

    private function writeLog($level, $message, $context)
    {

        if (in_array(env("APP_ENV"), ["dev", "local"])) {
            $this->write($level, $message, $context);
            return;
        }

        if (isset($context['sm']) && !empty($context['sm'])) {
            $topic = $this->topic . '_' . $context['sm'] . '_' . $level;
        } else {
            $topic = $this->topic . '_' . $level;
        }

        $contents = $this->_structureContents($level, $message, $context);

        $logItem = $this->_getLogItem();
        $logItem->setTime(time());
        $logItem->setContents($contents);
        $logItem->pushBack('Message', $message);
        $logItems = array($logItem);
        $request = new \Aliyun_Log_Models_PutLogsRequest($this->project, $this->logStore, $topic, "", $logItems);

        try {
            $this->client->putLogs($request);
        } catch (\Aliyun_Log_Exception $ex) {
            var_dump($ex->getMessage());
        }

    }

    public function __invoke(array $config)
    {
        if (isset($config['config'])) {
            $this->config = $config['config'];

            if (!static::$initConfigFlag) {
                $this->_initConfig();
            }
        }
        return $this;
    }

    private function _getLogItem()
    {
        return $logItem = new \Aliyun_Log_Models_LogItem();
    }

    private function _initConfig()
    {

        $this->endPoint = $this->config['endPoint'];

        $this->accessKeyId = $this->config['accessKeyId'];

        $this->accessKey = $this->config['accessKey'];

        $this->project = $this->config['project'];

        $this->logStore = $this->config['logStore'];

        $this->request = app("request");

        $this->client = new \Aliyun_Log_Client($this->endPoint, $this->accessKeyId, $this->accessKey);

        static::$initConfigFlag = true;
    }

    private function _structureContents($level, $message, $context)
    {

        $contents = [
            "user_agent" => $this->request->server('HTTP_USER_AGENT', ''),
            "host" => $this->request->server('HTTP_HOST', ''),
            "client_ip" => $this->_getUserIp() ?? '',
            "request_method" => $this->request->method() ?? '',
            "request_referer" => $this->request->server('HTTP_REFERER', ''),
            "request_date" => date("Y-m-d H:i:s", time()),
            "request_uri" => $this->request->server('REQUEST_URI', ''),
            "request_type" => "LOG",
            "Level" => $level,
            "request_flag" => $context['flag'] ?? '',
            "Content" => json_encode($context, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES),
            "request_length" => strlen($message)
        ];

        return $contents;

    }

    private function _getUserIp()
    {

        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realIP = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realIP = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "";
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realIP = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realIP = getenv("HTTP_CLIENT_IP");
            } else {
                $realIP = getenv("REMOTE_ADDR");
            }
        }

        return $realIP;
    }

}
