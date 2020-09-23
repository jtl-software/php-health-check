# Introduction

This is a lightweight lib for creating health checks in php.

```php 
<?php

use Jtl\HealthCheck\AbstractHealthCheck;
use Jtl\HealthCheck\Result;
use Jtl\HealthCheck\ResultDetail;
use Jtl\HealthCheck\ResultMessage;

$healthCheck = new class extends AbstractHealthCheck {
    public function check(): Result
    {
        $passed = true;

        $details = [
            new ResultDetail('app', true),
            new ResultDetail('db', true),
        ];

        $messages =  [
            new ResultMessage('info', 'app', 'Everything is tutti');
        ];

        return new Result($passed, $details, $messages);
    }
};

//Outputs a json response with either http status 200 or 500.
$healthCheck->checkAndSendResult();
```