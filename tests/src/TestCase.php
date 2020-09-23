<?php


namespace Jtl\HealthCheck\Test;

use Jtl\HealthCheck\HealthCheckResult;
use Jtl\HealthCheck\HealthCheckResultMessage;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @return HealthCheckResult[]
     */
    public function resultDataProvider(): array
    {
        return [
            [new HealthCheckResult(false, ['foo' => 'bar'], [new HealthCheckResultMessage('error', 'foo', 'foobar')])],
            [new HealthCheckResult(true, ['bool' => false])],
            [new HealthCheckResult(true, [], [new HealthCheckResultMessage('error', 'foo', 'foobar')])],
            [new HealthCheckResult(false)],
        ];
    }
}
