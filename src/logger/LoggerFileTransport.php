<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 11:04
 */

namespace DenisKhodakovskiyESI\src\logger;

class LoggerFileTransport implements ILoggerTransport
{
    /**
     * @var string
     */
    private $directory;

    public function __construct($logFolderPath = null)
    {
        $this->directory = $logFolderPath ?: '/log';
    }

    public function log($message, $category, $level)
    {
        $filePath = rtrim($this->directory, DIRECTORY_SEPARATOR) . "/{$category}_" . (new \DateTime())->format('dmY') . '.log';

        if (!file_exists($filePath)) {
            try {
                mkdir($this->directory, 0777, true);
                file_put_contents($filePath, '');
            } catch (\Exception $exception) {
            }
        }
        try {
            $message = (new \DateTime())->format('Y.m.d H:i:s') . " [{$level}] {$message}" . PHP_EOL;
            file_put_contents($filePath, $message, FILE_APPEND);
        } catch (\Exception $exception) {
        }
    }
}
