<?php

namespace Chronoarc\Comicvine\Resources;

use Chronoarc\Comicvine\Requests\GetTypesRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class MetaResource extends BaseResource
{
    public function types(): Response
    {
        return $this->connector->send(new GetTypesRequest());
    }

}