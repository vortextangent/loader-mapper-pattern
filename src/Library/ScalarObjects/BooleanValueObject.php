<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

use riskalyze\core\libraries\exceptions\InvalidArgumentException;

class BooleanValueObject
{
    /**
     * @var bool
     */
    private $status;

    public function __construct($status)
    {
        $this->ensureIsBoolean($status);

        $this->status = $status;
    }

    private function ensureIsBoolean($status)
    {
        if (!is_bool($status)) {
            throw new InvalidArgumentException(static::class . 'must be a boolean.');
        }
    }

    /**
     * @return boolean
     */
    public function asBool()
    {
        return $this->status;
    }
}
