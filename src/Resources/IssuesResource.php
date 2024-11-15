<?php

namespace Chronoarc\Comicvine\Resources;

use Chronoarc\Comicvine\Requests\GetIssueRequest;
use Chronoarc\Comicvine\Requests\GetIssuesRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class IssuesResource extends BaseResource
{
    public function all(?int $limit = null, ?int $offset = null): Response
    {
        return $this->connector->send(new GetIssuesRequest($limit, $offset));
    }

    public function get(int $id): Response
    {
        return $this->connector->send(new GetIssueRequest($id));
    }

}