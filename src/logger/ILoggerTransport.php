<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 11:00
 */

namespace DenisKhodakovskiyESI\src\logger;

interface ILoggerTransport
{
    const LEVEL_WARNING = 'WARNING';
    const LEVEL_ERROR   = 'ERROR';
    const LEVEL_FATAL   = 'FATAL';
    const LEVEL_INFO    = 'INFO';

    /**
     * @param string $message
     * @param string $category
     * @param string $level
     * @return mixed|void
     */
    public function log($message, $category, $level);
}
