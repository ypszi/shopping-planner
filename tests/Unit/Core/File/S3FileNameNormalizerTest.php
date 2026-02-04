<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\Core\File;

use PeterPecosz\ShoppingPlanner\Core\File\S3FileNameNormalizer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class S3FileNameNormalizerTest extends TestCase
{
    private S3FileNameNormalizer $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new S3FileNameNormalizer();
    }

    #[Test]
    public function testNormalize(): void
    {
        $this->assertMatchesRegularExpression(
            '/^[a-z-0-9]{64}$/',
            $this->sut->normalize('Alpesi Sajtos-Tészta (~Älplermagronen) / Alpesi_Macaroni')
        );
    }
}
