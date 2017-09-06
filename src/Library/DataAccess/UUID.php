<?php

    namespace Library\DataAccess;

    use Library\Exceptions\InvalidArgumentException;

    class UUID extends Identifier
    {
        /**
         * @var string
         */
        private $uuid;

        /**
         * @param string $uuid
         */
        private function __construct($uuid = "")
        {
            if (empty($uuid)) {
                $uuid = $this->generateUuid();
            }

            $this->ensureIsVersion4UUID($uuid);
            $this->uuid = $uuid;
        }

        /**
         * @return mixed
         */
        public static function generate()
        {
            return new static();
        }

        /**
         * @param string $string
         *
         * @return mixed
         * @throws InvalidArgumentException
         */
        public static function fromString($string)
        {
            if (empty($string)) {
                throw new InvalidArgumentException('Cannot be empty');
            }
            return new static($string);
        }

        /**
         * @return string
         */
        public function __toString()
        {
            return (string)$this->uuid;
        }

        /**
         * @param UUID $uuid
         *
         * @return bool
         */
        public function equals(UUID $uuid)
        {
            return $this->uuid === $uuid->asString();
        }

        /**
         * @param $string
         *
         * @throws InvalidArgumentException
         */
        private function ensureIsVersion4UUID($string)
        {
            if (strlen($string) != 36 || !$this->hasValidTwentiethCharacter($string) || !$this->hasValidFifteenthCharacter(
                    $string
                ) || !$this->hasValidFormat($string)
            ) {
                throw new InvalidArgumentException("Cannot Create UUID from invalid string");
            }
        }

        /**
         * @return string version 4 uuid
         */
        private function generateUuid()
        {
            return sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0x0fff) | 0x4000,
                random_int(0, 0x3fff) | 0x8000,
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0xffff)
            );
        }

        /**
         * @param $string
         *
         * @return bool
         */
        private function hasValidTwentiethCharacter($string)
        {
            return in_array(substr($string, 19, 1), ['8', '9', 'a', 'b']);
        }

        /**
         * @param $string
         *
         * @return bool
         */
        private function hasValidFifteenthCharacter($string)
        {
            return substr($string, 14, 1) == 4;
        }

        /**
         * @param $string
         *
         * @return int
         */
        private function hasValidFormat($string)
        {
            $pattern = "/[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-4[0-9a-fA-F]{3}\-[89ab][0-9a-fA-F]{3}\-[0-9a-fA-F]{12}/";

            return preg_match($pattern, $string);
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
            return $this->uuid;
        }

        /**
         * @return number
         */
        public function asInt()
        {
            return bindec(hex2bin(str_replace('-','',$this->uuid)));
        }
    }
