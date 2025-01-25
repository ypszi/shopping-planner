<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

readonly class ThumbnailFactory
{
    private const MIME_TYPE_EXTENSION_MAP = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
    ];

    public function __construct(
        private ClientInterface $httpClient,
        private string $thumbnailCachePath,
        private string $thumbnailWebPath
    ) {
    }

    public function create(string $foodName, ?string $thumbnailUrl): ?string
    {
        if (!$thumbnailUrl) {
            return null;
        }

        $thumbnail = $this->findThumbnail($foodName);

        if ($thumbnail) {
            return $thumbnail->getAssetPath();
        }

        $response     = $this->httpClient->sendRequest(new Request('GET', $thumbnailUrl));
        $responseCode = $response->getStatusCode();

        if (
            $responseCode === StatusCodeInterface::STATUS_MOVED_PERMANENTLY
            || $responseCode === StatusCodeInterface::STATUS_FOUND
        ) {
            $thumbnailUrl = $response->getHeaderLine('Location');
            $response     = $this->httpClient->sendRequest(new Request('GET', $thumbnailUrl));
            $responseCode = $response->getStatusCode();
        }

        if ($responseCode !== StatusCodeInterface::STATUS_OK) {
            return $thumbnailUrl;
        }

        $thumbnail = $this->saveThumbnail($foodName, $response);

        return $thumbnail->getAssetPath();
    }

    private function findThumbnail(string $foodName): ?Thumbnail
    {
        foreach (self::MIME_TYPE_EXTENSION_MAP as $extension) {
            $fileName = $foodName . '.' . $extension;

            if (file_exists($this->thumbnailCachePath . $fileName)) {
                return new Thumbnail(
                    $this->thumbnailCachePath . $fileName,
                    $this->thumbnailWebPath . $fileName,
                    $extension
                );
            }
        }

        return null;
    }

    private function saveThumbnail(string $foodName, ResponseInterface $response): Thumbnail
    {
        $mimeType  = $response->getHeaderLine('Content-Type');
        $extension = self::MIME_TYPE_EXTENSION_MAP[$mimeType] ?? null;

        if (!isset($extension)) {
            throw new InvalidArgumentException(sprintf('Mime type "%s" is not supported.', $mimeType));
        }

        $fileName  = $foodName . '.' . $extension;
        $thumbnail = new Thumbnail(
            $this->thumbnailCachePath . $fileName,
            $this->thumbnailWebPath . $fileName,
            $extension
        );

        if (!is_dir($this->thumbnailCachePath)) {
            mkdir($this->thumbnailCachePath, 0755, true);
        }

        if (!file_exists($thumbnail->getFilePath())) {
            touch($thumbnail->getFilePath());
        }

        file_put_contents($thumbnail->getFilePath(), (string)$response->getBody());

        return $thumbnail;
    }
}
