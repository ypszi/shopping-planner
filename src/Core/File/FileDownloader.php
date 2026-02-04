<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\File;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

readonly class FileDownloader
{
    public function __construct(
        private ClientInterface $httpClient,
    ) {
    }

    public function download(string $url): ?File
    {
        $response = $this->request($url);

        if (!$response) {
            return null;
        }

        $mimeType = $response->getHeaderLine('Content-Type');

        return new File(
            fileName: hash('sha256', trim($url)),
            mimeType: $mimeType,
            content : (string)$response->getBody()
        );
    }

    private function request(string $url): ?ResponseInterface
    {
        $response     = $this->httpClient->sendRequest(new Request('GET', $url));
        $responseCode = $response->getStatusCode();

        if (
            $responseCode === StatusCodeInterface::STATUS_MOVED_PERMANENTLY
            || $responseCode === StatusCodeInterface::STATUS_FOUND
        ) {
            $url          = $response->getHeaderLine('Location');
            $response     = $this->httpClient->sendRequest(new Request('GET', $url));
            $responseCode = $response->getStatusCode();
        }

        if ($responseCode !== StatusCodeInterface::STATUS_OK) {
            return null;
        }

        return $response;
    }
}
