<?php


    namespace Library\DataAccess;


    use JsonSerializable;

    abstract class Identifier implements JsonSerializable
    {
        /**
         * @return string
         */
        public function asString()
        {
            return $this->__toString();
        }

        /**
         * @return int
         */
        abstract public function asInt();

        /**
         * @return string
         */
        abstract public function __toString();

    }