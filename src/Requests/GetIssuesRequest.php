<?php

namespace Chronoarc\Comicvine\Requests;

use Chronoarc\Comicvine\Dto\Issue\Issue;
use Chronoarc\Comicvine\Dto\Issue\IssuesList;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetIssuesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly ?int $limit = null, private readonly ?int $offset = null)
    {
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'limit' => $this->limit,
            'offset' => $this->offset
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/issues';
    }

    public function createDtoFromResponse(Response $response): IssuesList
    {
        $json = $response->json();

        return new IssuesList(
            $json['number_of_total_results'],
            array_map(fn($issue) => Issue::fromArray($issue), $json['results'])
        );
    }
}