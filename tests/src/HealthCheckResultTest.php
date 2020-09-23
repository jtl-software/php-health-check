<?php

namespace Jtl\HealthCheck\Test;

use Jtl\HealthCheck\HealthCheckResult;

class HealthCheckResultTest extends TestCase
{
    /**
     * @dataProvider resultDataProvider
     *
     * @param HealthCheckResult $result
     */
    public function testToArray(HealthCheckResult $result)
    {
        $expectedArray = ['passed' => $result->hasPassed()];

        if ($result->hasData()) {
            $expectedArray['data'] = $result->getData();
        }

        if ($result->hasMessages()) {
            foreach ($result->getMessages() as $message) {
                $expectedArray['messages'][] = $message->toArray();
            }
        }

        $this->assertEquals($expectedArray, $result->toArray());
    }
}
