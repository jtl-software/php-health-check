<?php

namespace Jtl\HealthCheck;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractHealthCheck
{
    /**
     * @var JsonResponse
     */
    protected $response;

    /**
     * AbstractHealthCheck constructor.
     */
    public function __construct()
    {
        $this->response = new JsonResponse();
    }

    /**
     * @return Result
     */
    abstract public function check(): Result;

    /**
     * @param Result $result
     */
    public function sendResult(Result $result): void
    {
        $this
            ->response
            ->setData($result)
            ->setStatusCode($result->hasPassed() ? 200 : 500)
            ->send();
    }

    /**
     *
     */
    public function checkAndSendResult(): void
    {
        $this->sendResult($this->check());
    }

    /**
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        return $this->response;
    }

    /**
     * @param JsonResponse $response
     * @return AbstractHealthCheck
     */
    public function setResponse(JsonResponse $response): self
    {
        $this->response = $response;
        return $this;
    }
}
