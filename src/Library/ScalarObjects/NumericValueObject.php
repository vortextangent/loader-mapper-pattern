<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

use riskalyze\core\libraries\exceptions\InvalidArgumentException;

class NumericValueObject
{
    private $number;

    /**
     * NumericValueObject constructor.
     * @param $number
     */
    public function __construct($number)
    {
        $this->ensureIsNumeric($number);

        $this->number = $number;
    }

    private function ensureIsNumeric($number)
    {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException(
                get_class($this) . " is expecting a numeric value.  A " . gettype(
                    $number
                ) . " ({$number}) was provided."
            );
        }
    }
}
