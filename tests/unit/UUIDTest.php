<?php

    namespace RiskalyzeDomainObjects\Library\DataAccess;

    use PHPUnit\Framework\TestCase;
    use riskalyze\core\libraries\exceptions\InvalidArgumentException;

    /**
     * @small
     *
     * @covers \RiskalyzeDomainObjects\Library\DataAccess\UUID
     * @uses   \RiskalyzeDomainObjects\Library\DataAccess\Identifier
     */
    class UUIDTest extends TestCase
    {
        /**
         * Version 4 uuid
         * 16-octet (128-bit) number
         * 8-4-4-4-12 for a total of 36 characters
         * 32 alphanumeric characters and four hyphens
         * xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx
         * where x is any hexadecimal digit and y is one of 8, 9, A, or B
         */
        public function testCanGenerateVersion4UUID()
        {
            $aggregateIds = [];
            $iterations   = 2;
            for ($i = 0; $i < $iterations; $i++) {
                $aggregateId    = UUID::generate();
                $aggregateId    = $aggregateId->asString();
                $aggregateIds[] = $aggregateId;

                $pattern = "/[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-4[0-9a-fA-F]{3}\-[89ab][0-9a-fA-F]{3}\-[0-9a-fA-F]{12}/";
                preg_match($pattern, $aggregateId, $matches);
                $this->assertCount(1, $matches);
            }
            $uniqueIds = array_unique($aggregateIds);
            $this->assertCount($iterations, $uniqueIds);
        }

        public function testCanGenerateUUIDFromString()
        {
            $string = 'aaaaaaaa-ffff-4fff-8fff-aaaaaaaaaaaa';
            $uuid   = UUID::fromString($string);
            $this->assertInstanceOf(UUID::class, $uuid);
        }

        public function testCanNotGenerateUUIDFromInvalidString()
        {
            $string = 'aaaaaaaa-ffff-4fff-8fff-aaaaaaaaaaag';

            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage("Cannot Create UUID from invalid string");
            UUID::fromString($string);
        }

        public function testCanCompareUUIDs()
        {
            $a = UUID::generate();
            $b = UUID::generate();
            $this->assertTrue($a->equals($a));
            $this->assertFalse($a->equals($b));
        }
    }
