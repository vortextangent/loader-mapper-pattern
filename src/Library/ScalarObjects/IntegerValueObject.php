<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

use riskalyze\core\libraries\exceptions\InvalidArgumentException;

abstract class IntegerValueObject
{
    /**
     * @var int
     */
    private $int;

    public function __construct($int)
    {
        $this->ensureIsInt($int);

        $this->int = $int;
    }

    private function ensureIsInt($int)
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
    public function __toString()
    {
        return (string) $this->int;
    }

    /**
     * @return int
     */
    public function asInt()
    {
        return $this->int;
    }
}
