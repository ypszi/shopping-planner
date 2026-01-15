<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Core\Storage\File;
use PeterPecosz\ShoppingPlanner\Core\Storage\Storage;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

readonly class ThumbnailFactory
{
    public function __construct(
        private ClientInterface $httpClient,
        private Storage $storage,
    ) {
    }

    public function create(Product $product, ?string $thumbnailUrl): ?Thumbnail
    {
        if (empty($thumbnailUrl)) {
            return null;
        }

        $thumbnail = $this->storage->get(filename: $product->name());

        if ($thumbnail) {
            return $thumbnail;
        }

        $response = $this->download($thumbnailUrl);

        if (!$response) {
            return null;
        }

        $mimeType = $response->getHeaderLine('Content-Type');
        $file     = new File(
            fileName: $product->name(),
            mimeType: $mimeType,
            content : (string)$response->getBody()
        );

        return $this->storage->save($file);
    }

    private function download(string $thumbnailUrl): ?ResponseInterface
    {
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
            return null;
        }

        return $response;
    }
}
