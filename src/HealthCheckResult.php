<?php

namespace Jtl\HealthCheck;

class HealthCheckResult implements \JsonSerializable
{
    /**
     * @var boolean
     */
    protected $passed;

    /**
     * @var mixed[]
     */
    protected $data = [];

    /**
     * @var HealthCheckResultMessage[]
     */
    protected $messages = [];

    /**
     * HealthCheckResult constructor.
     * @param bool $passed
     * @param mixed[] $data
     * @param HealthCheckResultMessage[] $messages
     */
    public function __construct(bool $passed, array $data = [], array $messages = [])
    {
        $this->passed = $passed;
        $this->data = $data;
        $this->messages = $messages;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $data = [
            'passed' => $this->passed
        ];

        if ($this->hasData()) {
            $data['data'] = $this->data;
        }

        if ($this->hasMessages()) {
            $data['messages'] = array_map(function (HealthCheckResultMessage $message) {
                return $message->toArray();
            }, $this->messages);
        }

        return $data;
    }

    /**
     * @return bool[]|mixed|mixed[]
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return boolean
     */
    public function hasData(): bool
    {
        return count($this->data) > 0;
    }

    /**
     * @return HealthCheckResultMessage[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return boolean
     */
    public function hasMessages(): bool
    {
        return count($this->messages) > 0;
    }

    /**
     * @return bool
     */
    public function hasPassed(): bool
    {
        return $this->passed;
    }
}
