<?php

namespace Chronoarc\Comicvine\Requests;

use Chronoarc\Comicvine\Dto\Meta\Type;
use Chronoarc\Comicvine\Dto\Meta\TypesList;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTypesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/types';
    }

    public function createDtoFromResponse(Response $response): TypesList
    {
        $json = $response->json();

        return new TypesList(
            $json['number_of_total_results'],
            array_map(fn($result) => new Type(
                $result['id'],
                $result['detail_resource_name'],
                $result['list_resource_name']
            ), $json['results'])
        );
    }
}