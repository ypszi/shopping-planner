<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel\Factory;

use PeterPecosz\Kajatervezo\Etel\ChilisBab;
use PeterPecosz\Kajatervezo\Etel\Exception\UnknownEtelException;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EtelFactoryTest extends TestCase
{
    #[Test]
    public function testCreate(): void
    {
        $this->assertEquals(new ChilisBab(adag: 4), EtelFactory::create(name: ChilisBab::name()));
    }

    #[Test]
    public function testCreateFailsWhenEtelIsUnknown(): void
    {
        $this->expectException(UnknownEtelException::class);
        $this->expectExceptionMessage('Unknown etel found: "unknown food"');

        EtelFactory::create(name: 'unknown food');
    }

    #[Test]
    public function testListAvailableEtelek(): void
    {
        $this->assertCount(20, EtelFactory::listAvailableEtelek());
    }
}
