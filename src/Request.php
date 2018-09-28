<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 10:25
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\logger\Logger;
use DenisKhodakovskiyESI\src\logger\LoggerFileTransport;

class Request
{
    const TYPE_GET    = 'GET';
    const TYPE_PUT    = 'PUT';
    const TYPE_POST   = 'POST';
    const TYPE_DELETE = 'DELETE';

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $type = self::TYPE_GET;
    protected $data;
    protected $header;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct($uri, $type = null)
    {
        $this->uri = $uri;
        if ($type) {
            $this->type = $type;
        }
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function execute()
    {
        $url = "https://esi.evetech.net/latest{$this->uri}";
        $this->getLogger()->log("Sending request: {$url}", 'request');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            $this->type == self::TYPE_POST ? CURLOPT_POST : CURLOPT_CUSTOMREQUEST,
            $this->type == $this::TYPE_POST ? true : $this->type
        );
        if ($this->data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        }
        if ($this->header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        }
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            $this->getLogger()->log("cURL error #{$errno}: {$error}", 'request');
            return null;
        }

        $data = json_decode($result, true);
        if (isset($data['error'])) {
            throw new \Exception($data['error'], 400);
        }

        return $data;
    }

    public function getLogger()
    {
        if (!$this->logger) {
            $this->logger = new Logger(new LoggerFileTransport('/var/www/html/esi/log'));
        }

        return $this->logger;
    }
}
