<?php

declare(strict_types=1);

namespace App\Service\MindboxApiClient;

use App\MindboxMessages\MindboxMessages;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class MindboxApiClient
{
    const METHOD_POST = 'POST';

    const STATUS_OK = 200;
    const STATUS_OK_CODE = 'Success';

    private Client $guzzleHttpClient;
    private string $mindboxApiHost;
    private string $mindboxApiEndpoint;
    private string $mindboxSecretKey;
    private Response $result;

    public function __construct(
        Client $guzzleHttpClient,
        string $mindboxApiHost,
        string $mindboxApiEndpoint,
        string $mindboxSecretKey
    ) {
        $this->guzzleHttpClient = $guzzleHttpClient;
        $this->mindboxApiHost = $mindboxApiHost;
        $this->mindboxApiEndpoint = $mindboxApiEndpoint;
        $this->mindboxSecretKey = $mindboxSecretKey;
    }

    /**
     * @throws GuzzleException
     */
    public function post(MindboxMessages $mindboxApiMessage): self
    {
        return $this->execute($mindboxApiMessage, self::METHOD_POST);
    }

    /**
     * @throws GuzzleException
     */
    public function execute(MindboxMessages $mindboxApiMessage, string $method, int $timeout = 20): self
    {
        $headers = [
            'Authorization' => 'Mindbox secretKey="' . $this->mindboxSecretKey . '"',
            'Accept'        => 'application/json',
        ];
        $headers = array_merge($headers, $mindboxApiMessage->headers());

        $queryParams = array_merge($mindboxApiMessage->queryParams(), [
            'endpointId' => $this->mindboxApiEndpoint
        ]);

        $queryResult = $this->guzzleHttpClient->request(
            $method,
            $this->mindboxApiHost . $mindboxApiMessage->apiUrl(),
            [
                'headers' => $headers,
                'body'    => $mindboxApiMessage->body(),
                'query'   => $queryParams,
                'timeout' => $timeout,
            ]
        );

        $this->setResult($queryResult);

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->result->getStatusCode();
    }

    public function isStatusOk(): bool
    {
        return $this->result->getStatusCode() === self::STATUS_OK && $this->getResponseArrayContents()['status'] === self::STATUS_OK_CODE;
    }

    public function getResponseStrContents(): string
    {
        return $this->result->getBody()->getContents();
    }

    public function getResponseArrayContents(): array
    {
        return json_decode($this->result->getBody()->getContents(), true);
    }

    private function setResult(Response $result)
    {
        $this->result = $result;
    }
}