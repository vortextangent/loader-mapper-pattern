<?php

    namespace RiskalyzeDomainObjects\Library\ScalarObjects;

    use Library\Exceptions\InvalidArgumentException;

class NumericValueObject
{

    /**
     * @var
     */
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

    /**
     * @param $number
     *
     * @throws InvalidArgumentException
     */
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
