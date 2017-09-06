<?php

namespace RiskalyzeDomainObjects\Library\ScalarObjects;

use JsonSerializable;
use Library\Exceptions\InvalidArgumentException;

abstract class StringValueObject implements JsonSerializable
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->ensureIsString($string);

        $this->string = $string;
    }

    /**
     * @param $string
     * @throws InvalidArgumentException
     */
    protected function ensureIsString($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException(static::class . " must be a string.");
        }
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->string;
    }

    /**
     * @param  StringValueObject $string
     * @return bool
     */
    public function equals(StringValueObject $string)
    {
        return ($this->asString() === $string->asString());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->asString();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return (string)$this;
    }
}
