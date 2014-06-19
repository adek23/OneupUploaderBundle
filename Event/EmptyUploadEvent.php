<?php

namespace Oneup\UploaderBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Oneup\UploaderBundle\Uploader\Response\ResponseInterface;

class EmptyUploadEvent extends Event
{
    protected $request;
    protected $type;
    protected $response;
    protected $config;

    public function __construct(ResponseInterface $response, Request $request, $type, array $config)
    {
        $this->request = $request;
        $this->response = $response;
        $this->type = $type;
        $this->config = $config;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
