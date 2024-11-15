<?php

use Chronoarc\Comicvine\Comicvine;
use Chronoarc\Comicvine\Dto\Issue\Issue;
use Chronoarc\Comicvine\Dto\Issue\IssuesList;
use Chronoarc\Comicvine\Dto\Issue\IssueVolume;
use Chronoarc\Comicvine\Requests\GetIssueRequest;
use Chronoarc\Comicvine\Requests\GetIssuesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

beforeEach(function () {
    $this->mockClient = new MockClient([
        GetIssueRequest::class => MockResponse::fixture('valid_single_issue'),
        GetIssuesRequest::class => MockResponse::fixture('valid_issues_list'),
    ]);

    $this->connector = new Comicvine($_ENV['COMICVINE_API_KEY']);
    $this->connector->withMockClient($this->mockClient);
});

test('can fetch single issue', function () {
    /** @var Issue $dto */
    $dto = $this->connector->send(new GetIssueRequest(6))->dto();

    $this->mockClient->assertSent(function (Request $request) {
        return $request->resolveEndpoint() === '/issue/4000-6';
    });

    expect($dto->id)->toBe(6)
        ->and($dto->name)->toBe('The Lost Race')
        ->and($dto->volume->id)->toBe(1487)
        ->and($dto->volume->name)->toBe('Chamber of Chills Magazine')
        ->and($dto->volume)->toBeInstanceOf(IssueVolume::class);
});

test('can fetch issues list', function () {
    /** @var IssuesList $dto */
    $dto = $this->connector->send(new GetIssuesRequest())->dto();

    $this->mockClient->assertSent(function (Request $request) {
        return $request->resolveEndpoint() === '/issues';
    });

    expect($dto->numberOfTotalResults)->toBe(1024872)
        ->and($dto->results)->toHaveCount(100)
        ->and($dto->results[0]->id)->toBe(6)
        ->and($dto->results[0]->name)->toBe('The Lost Race')
        ->and($dto->results[0]->volume->id)->toBe(1487)
        ->and($dto->results[0]->volume->name)->toBe('Chamber of Chills Magazine')
        ->and($dto->results[0]->volume)->toBeInstanceOf(IssueVolume::class);
});