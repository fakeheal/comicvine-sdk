<?php

namespace Chronoarc\Comicvine;

use Chronoarc\Comicvine\Resources\IssuesResource;
use Chronoarc\Comicvine\Resources\MetaResource;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\QueryAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Comicvine extends Connector
{
    public function __construct(private readonly string $apiKey)
    {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://comicvine.com/api';
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new QueryAuthenticator('api_key', $this->apiKey);
    }


    protected function defaultQuery(): array
    {
        return [
            'format' => 'json',
        ];
    }

    public function issues(): IssuesResource
    {
        return new IssuesResource($this);
    }

    public function meta(): MetaResource
    {
        return new MetaResource($this);
    }
}