<?php
namespace Veksa\Carrot\Exceptions;

/**
 * Class HttpException
 *
 * @codeCoverageIgnore
 * @package Veksa\Carrot
 */
class HttpException extends Exception
{
    /**
     * @var string
     */
    public $response;

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
