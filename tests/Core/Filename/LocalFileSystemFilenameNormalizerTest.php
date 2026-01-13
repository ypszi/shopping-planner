<?php

declare(strict_types=1);

namespace Core\Filename;

use PeterPecosz\ShoppingPlanner\Core\Filename\LocalFileSystemFileNameNormalizer;
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
