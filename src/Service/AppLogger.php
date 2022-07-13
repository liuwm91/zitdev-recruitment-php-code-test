<?php

namespace App\Service;

use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    private $logger;
    private $driver;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        $this->driver = $type;
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        }
        if ($type == 'think-log') {
            $this->logger = Log::init([
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'path'	=>	'./logs/',
                    ],
                ],
            ]);
        }
    }

    public function info($message = '')
    {
        if ($this->driver == 'think-log') {
            Log::info(strtoupper($message));
        } else {
            $this->logger->info($message);
        }
    }

    public function debug($message = '')
    {
        if ($this->driver == 'think-log') {
            Log::debug(strtoupper($message));
        } else {
            $this->logger->debug($message);
        }
    }

    public function error($message = '')
    {
        if ($this->driver == 'think-log') {
            Log::debug(strtoupper($message));
        } else {
            $this->logger->error($message);
        }
    }
}