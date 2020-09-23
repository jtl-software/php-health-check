<?php

namespace Jtl\HealthCheck\Test;

use Jtl\HealthCheck\Result;

class HealthCheckResultTest extends TestCase
{
    /**
     * @dataProvider resultDataProvider
     *
     * @param Result $result
     */
    public function testToArray(Result $result)
    {
        $expectedArray = ['passed' => $result->hasPassed()];

        if ($result->hasDetails()) {
            foreach ($result->getDetails() as $detail) {
                $expectedArray['details'][$detail->getSubject()] = $detail->getValue();
            }
        }

        if ($result->hasMessages()) {
            foreach ($result->getMessages() as $message) {
                $expectedArray['messages'][] = $message->toArray();
            }
        }

        $this->assertEquals($expectedArray, $result->toArray());
    }
}
