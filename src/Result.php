<?php

namespace Jtl\HealthCheck;

class Result implements \JsonSerializable
{
    /**
     * @var boolean
     */
    protected $passed;

    /**
     * @var ResultDetail[]
     */
    protected $details = [];

    /**
     * @var ResultMessage[]
     */
    protected $messages = [];

    /**
     * HealthCheckResult constructor.
     * @param bool $passed
     * @param ResultDetail ...$details
     * @param ResultMessage ...$messages
     */
    public function __construct(bool $passed, array $details = [], array $messages = [])
    {
        $this->passed = $passed;
        $this->setDetails(...$details);
        $this->setMessages(...$messages);
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $data = [
            'passed' => $this->passed
        ];

        if ($this->hasDetails()) {
            foreach ($this->details as $detail) {
                $data['details'][$detail->getSubject()] = $detail->getValue();
            }
        }

        if ($this->hasMessages()) {
            $data['messages'] = array_map(function (ResultMessage $message) {
                return $message->toArray();
            }, $this->messages);
        }

        return $data;
    }

    /**
     * @return bool[]|mixed|mixed[]
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @param ResultDetail $detail
     * @return Result
     */
    public function addDetail(ResultDetail $detail): self
    {
        $this->details[] = $detail;
        return $this;
    }

    /**
     * @return ResultDetail[]
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return boolean
     */
    public function hasDetails(): bool
    {
        return count($this->details) > 0;
    }

    /**
     * @param ResultDetail ...$details
     * @return Result
     */
    protected function setDetails(ResultDetail ...$details): self
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @param ResultMessage $message
     * @return Result
     */
    public function addMessage(ResultMessage $message): self
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * @return ResultMessage[]
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
     * @param ResultMessage ...$messages
     * @return Result
     */
    protected function setMessages(ResultMessage ...$messages): self
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPassed(): bool
    {
        return $this->passed;
    }
}
