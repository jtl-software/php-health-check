<?php


namespace Jtl\HealthCheck\Test;

use Jtl\HealthCheck\Result;
use Jtl\HealthCheck\ResultDetail;
use Jtl\HealthCheck\ResultMessage;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @return Result[]
     */
    public function resultDataProvider(): array
    {
        return [
            [new Result(false, [new ResultDetail('foo', 'bar')], [new ResultMessage('error', 'foo', 'foobar')])],
            [new Result(true, [new ResultDetail('bool', false)])],
            [new Result(true, [], [new ResultMessage('error', 'foo', 'foobar')])],
            [new Result(false)],
        ];
    }
}
