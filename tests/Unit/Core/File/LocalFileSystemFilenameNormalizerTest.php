<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\Core\File;

use PeterPecosz\ShoppingPlanner\Core\File\LocalFileSystemFileNameNormalizer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class LocalFileSystemFilenameNormalizerTest extends TestCase
{
    private LocalFileSystemFileNameNormalizer $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new LocalFileSystemFileNameNormalizer();
    }

    #[Test]
    public function testNormalize(): void
    {
        $this->assertEquals(
            'Alpesi Sajtos-Tészta (Älplermagronen) Alpesi_Macaroni',
            $this->sut->normalize('Alpesi Sajtos-Tészta (~Älplermagronen) / Alpesi_Macaroni')
        );
    }
}
