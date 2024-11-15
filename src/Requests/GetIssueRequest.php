<?php

namespace Chronoarc\Comicvine\Requests;

use Chronoarc\Comicvine\Dto\Issue\Issue;
use Chronoarc\Comicvine\Enum\ResourceTypeEnum;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetIssueRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/issue/'.ResourceTypeEnum::Issue->value.'-'.$this->id;
    }

    public function createDtoFromResponse(Response $response): ?Issue
    {
        $issue = $response->json()['results'];
        return Issue::fromArray($issue);
    }
}