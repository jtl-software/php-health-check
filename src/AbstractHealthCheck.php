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
     * @return HealthCheckResult
     */
    abstract public function check(): HealthCheckResult;

    /**
     * @param HealthCheckResult $result
     */
    public function sendResult(HealthCheckResult $result): void
    {
        $this
            ->response
            ->setData($result->toArray())
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
     */
    public function setResponse(JsonResponse $response): void
    {
        $this->response = $response;
    }
}