<?php

namespace Jtl\HealthCheck;

class ResultMessage
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $message;

    /**
     * HealthCheckResultMessage constructor.
     * @param string $status
     * @param string $subject
     * @param string $message
     * @throws \Exception
     */
    public function __construct(string $status, string $subject, string $message)
    {
        $this->status = $status;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     * @throws \Exception
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return ResultMessage
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ResultMessage
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'status' => $this->status,
            'subject' => $this->subject,
        ];
    }
}
