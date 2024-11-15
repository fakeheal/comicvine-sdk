<?php

use Chronoarc\Comicvine\Comicvine;
use Chronoarc\Comicvine\Dto\Meta\TypesList;
use Chronoarc\Comicvine\Requests\GetTypesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

beforeEach(function () {
    $this->mockClient = new MockClient([
        GetTypesRequest::class => MockResponse::fixture('valid_types_list'),
    ]);

    $this->connector = new Comicvine($_ENV['COMICVINE_API_KEY']);
    $this->connector->withMockClient($this->mockClient);
});

test('can fetch types list', function () {
    /** @var TypesList $dto */
    $dto = $this->connector->send(new GetTypesRequest())->dto();

    $this->mockClient->assertSent(function (Request $request) {
        return $request->resolveEndpoint() === '/types';
    });

    expect($dto->numberOfTotalResults)->toBe(20)
        ->and($dto->results)->toHaveCount(20)
        ->and($dto->results[0]->id)->toBe(4005)
        ->and($dto->results[1]->id)->toBe(2450);
});