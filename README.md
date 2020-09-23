# Introduction

This is a lightweight lib for creating health checks in php.

```php 
<?php

use Jtl\HealthCheck\AbstractHealthCheck;
use Jtl\HealthCheck\HealthCheckResult;
use Jtl\HealthCheck\HealthCheckResultMessage;

$check = new class extends AbstractHealthCheck {
    public function check(): HealthCheckResult
    {
        $passed = true;

        $data = ['app' => true, 'db' => true];

        $message = new HealthCheckResultMessage(HealthCheckResultMessage::STATUS_INFO, 'app', 'Everything is tutti');

        return new HealthCheckResult($passed, $data, [$message]);
    }
};

//Outputs a json response with either http status 200 or 500.
$check->checkAndSendResult();
```