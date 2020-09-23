<?php


namespace Jtl\HealthCheck;

use PHPUnit\Util\Exception;

class ResultDetail
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var boolean|double|integer|string
     */
    protected $value;

    /**
     * HealthCheckResultDetail constructor.
     * @param string $subject
     * @param boolean|double|integer|string $value
     */
    public function __construct(string $subject, $value)
    {
        if (!in_array(gettype($value), ['boolean', 'integer', 'double', 'string'])) {
            throw new Exception('Data type from value needs to be boolean, double, integer or string');
        }

        $this->subject = $subject;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
