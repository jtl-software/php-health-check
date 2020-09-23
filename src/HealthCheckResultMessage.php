<?php

namespace Jtl\HealthCheck;

class HealthCheckResultMessage
{
    public const
        STATUS_INFO = 'info',
        STATUS_WARNING = 'warning',
        STATUS_ERROR = 'error';

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
        $this->setStatus($status);
        $this->setSubject($subject);
        $this->setMessage($message);
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
        if (!self::isStatus($status)) {
            throw new \Exception(sprintf('%s is not a valid status', $status));
        }

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
     * @return HealthCheckResultMessage
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
     * @return HealthCheckResultMessage
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $status
     * @return boolean
     */
    public static function isStatus(string $status): bool
    {
        return in_array($status, [self::STATUS_ERROR, self::STATUS_INFO, self::STATUS_WARNING]);
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
