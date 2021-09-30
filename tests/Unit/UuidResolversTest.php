<?php

namespace Tests\Unit;

use Dyrynda\Database\Support\GeneratesUuid;
use PHPUnit\Framework\TestCase;

class UuidResolversTest extends TestCase
{
    /**
     * @see \Tests\Unit\UuidResolversTest::it_handles_uuid_versions
     *
     * @return array
     */
    public function provider_for_it_handles_uuid_versions()
    {
        return [
            ['uuid1', 'uuid1'],
            ['uuid4', 'uuid4'],
            ['uuid6', 'uuid6'],
            ['ordered', 'uuid6'],
            ['uuid999', 'uuid4'],
        ];
    }

    /**
     * @test
     *
     * @param  string  $version
     * @param  string  $resolved
     *
     * @dataProvider \Tests\Unit\UuidResolversTest::provider_for_it_handles_uuid_versions
     */
    public function it_handles_uuid_versions($version, $resolved)
    {
        /* @var \Dyrynda\Database\Support\GeneratesUuid $generator */
        $generator = $this->getMockForTrait(GeneratesUuid::class);
        $generator->uuidVersion = $version;

        $this->assertSame($resolved, $generator->resolveUuidVersion());
    }
}
