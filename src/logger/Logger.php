<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 11:01
 */

namespace DenisKhodakovskiyESI\src\logger;

class Logger
{
    /**
     * @var ILoggerTransport
     */
    private $transport;

    public function __construct(ILoggerTransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param string $message
     * @param string $category
     * @param string $level
     */
    public function log($message, $category, $level = ILoggerTransport::LEVEL_INFO)
    {
        $this->transport->log($message, $category, $level);
    }
}
