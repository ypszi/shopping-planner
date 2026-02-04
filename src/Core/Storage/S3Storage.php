<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use Aws\Exception\AwsException;
use Aws\S3\S3ClientInterface;
use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\File\File;
use PeterPecosz\ShoppingPlanner\Core\File\FileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;

readonly class S3Storage implements Storage
{
    public function __construct(
        private FileNameNormalizer $filenameNormalizer,
        private S3ClientInterface $client,
        private string $bucket,
        private string $region,
        private string $thumbnailCachePath,
        private string $thumbnailWebPath,
    ) {
    }

    public function get(string $fileName, Extension $extension): ?Thumbnail
    {
        try {
            $fileName = $this->filenameNormalizer->normalize($fileName) . '.' . $extension->value;
            $result   = $this->client->getObject(
                [
                    'Bucket' => $this->bucket,
                    'Key'    => $fileName,
                ]
            );

            $body = (string)$result['Body']; // binary image data

            if (empty($body)) {
                return null;
            }

            return new Thumbnail(
                filePath : $this->thumbnailCachePath . $fileName,
                assetPath: sprintf(
                    'https://%s.s3.%s.amazonaws.com/%s',
                    $this->bucket,
                    $this->region,
                    $this->thumbnailWebPath . $fileName
                ),
                extension: $extension,
            );
        } catch (AwsException $e) {
            if ($e->getAwsErrorCode() !== 'NoSuchKey') {
                throw $e;
            }
        }

        return null;
    }

    public function save(File $file): Thumbnail
    {
        $fileName = $this->filenameNormalizer->normalize($file->fileName()) . '.' . $file->extension()->value;

        $this->client->putObject(
            [
                'Bucket' => $this->bucket,
                'Key'    => $fileName,
            ]
        );

        return new Thumbnail(
            filePath : $this->thumbnailCachePath . $fileName,
            assetPath: $this->thumbnailWebPath . $fileName,
            extension: $file->extension(),
        );
    }
}
