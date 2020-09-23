<?php

namespace Jtl\HealthCheck\Test;

use Jtl\HealthCheck\AbstractHealthCheck;
use Jtl\HealthCheck\Result;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractHealthCheckTest extends TestCase
{
    /**
     * @dataProvider resultDataProvider
     *
     * @param Result $result
     */
    public function testSendData(Result $result)
    {
        $this->expectOutputString(json_encode($result->toArray()));

        $check = $this->getMockForAbstractClass(AbstractHealthCheck::class);

        $check->sendResult($result);
    }

    /**
     * @dataProvider resultDataProvider
     *
     * @param Result $result
     */
    public function testSendHttpStatus(Result $result)
    {
        $response = $this->getMockBuilder(JsonResponse::class)
            ->onlyMethods(['setData', 'setStatusCode'])
            ->getMock();

        $response
            ->expects($this->once())
            ->method('setData')
            ->with($result)
            ->willReturn($response);

        $response
            ->expects($this->once())
            ->method('setStatusCode')
            ->with($result->hasPassed() ? 200 : 500)
            ->willReturn($response);

        $check = $this->getMockForAbstractClass(AbstractHealthCheck::class);

        $check->setResponse($response);

        $check->sendResult($result);
    }

    /**
     * @dataProvider resultDataProvider
     *
     * @param Result $result
     */
    public function testCheckAndSendResult(Result $result)
    {
        $check = $this->getMockBuilder(AbstractHealthCheck::class)
            ->onlyMethods(['check', 'sendResult'])
            ->getMock();

        $check
            ->expects($this->once())
            ->method('check')
            ->willReturn($result);

        $check
            ->expects($this->once())
            ->method('sendResult')
            ->with($result);

        $check->checkAndSendResult();
    }
}
