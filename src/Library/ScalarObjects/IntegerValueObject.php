<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

use Library\Exceptions\InvalidArgumentException;

abstract class IntegerValueObject
{
    /**
     * @var int
     */
    private $int;

    /**
     * @param $int
     */
    public function __construct($int)
    {
        $this->ensureIsInt($int);

        $this->int = $int;
    }

    /**
     * @param $int
     *
     * @throws InvalidArgumentException
     */
    private function ensureIsInt($int): void
    {
        if (!is_int($int)) {
            throw new InvalidArgumentException(
                static::class . " is expecting an integer value.  A " . gettype($int) . " ({$int}) was provided."
            );
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->int;
    }

    /**
     * @return int
     */
    public function asInt(): int
    {
        return $this->int;
    }
}
