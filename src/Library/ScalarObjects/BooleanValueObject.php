<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

    use Library\Exceptions\InvalidArgumentException;

class BooleanValueObject
{
    /**
     * @var bool
     */
    private $status;

    /**
     * @param $status
     */
    public function __construct($status)
    {
        $this->ensureIsBoolean($status);

        $this->status = $status;
    }

    /**
     * @param $status
     *
     * @throws InvalidArgumentException
     */
    private function ensureIsBoolean($status): void
    {
        if (!is_bool($status)) {
            throw new InvalidArgumentException(static::class . 'must be a boolean.');
        }
    }

    /**
     * @return boolean
     */
    public function asBool(): bool
    {
        return $this->status;
    }
}
