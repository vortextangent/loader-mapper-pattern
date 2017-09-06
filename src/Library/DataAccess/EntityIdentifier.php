<?php

namespace Library\DataAccess;

use Library\Exceptions\InvalidArgumentException;

class EntityIdentifier extends Identifier
{

    /**
     * @var int
     */
    private $int;

    public function __construct($int = null)
    {
        $this->ensureIsInt($int);
        $this->int = $int;
    }

    public static function fromString($string)
    {
        self::ensureIsNotEmpty($string);
        self::ensureIsNumeric($string);

        return new static((int)$string);
    }

    /**
     * @param $int
     *
     * @throws InvalidArgumentException
     */
    private function ensureIsInt($int)
    {
        if ( ! is_int($int)) {
            throw new InvalidArgumentException(static::class . " is expecting an integer value.  A " . gettype($int) . " ({$int}) was provided.");
        }
    }

    /**
     * @param $string
     *
     * @throws InvalidArgumentException
     */
    private static function ensureIsNumeric($string): void
    {
        if ( ! is_numeric($string)) {
            throw new InvalidArgumentException("Must be numeric");
        }
    }

    /**
     * @param $string
     *
     * @throws InvalidArgumentException
     */
    private static function ensureIsNotEmpty($string): void
    {
        if (empty($string)) {
            throw new InvalidArgumentException("Cannot be empty");
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->int;
    }

    /**
     * @return int
     */
    public function asInt()
    {
        return $this->int;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this->int;
    }
}