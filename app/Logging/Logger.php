<?php

namespace App\Logging;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;

class Logger extends AbstractLogger
{
    use LoggerTrait;

    private $logFilePath;

    public function __construct(string $logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    public function log($level, $message, array $context = []): void
    {
        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . strtoupper($level) . ': ' . $message;

        if (!empty($context)) {
            $logMessage .= ' ' . json_encode($context);
        }

        $logMessage .= PHP_EOL;

        if (file_put_contents($this->logFilePath, $logMessage, FILE_APPEND) === false) {
            error_log('Failed to write log message to ' . $this->logFilePath);
        }
    }
}
