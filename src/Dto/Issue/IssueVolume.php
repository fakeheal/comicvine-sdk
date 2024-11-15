<?php

namespace Chronoarc\Comicvine\Dto\Issue;

class IssueVolume
{

    public function __construct(
        public int $id,
        public string $name,
        public ?string $apiDetailUrl,
        public ?string $siteDetailUrl,

    )
    {

    }

    public static function fromArray($volume): IssueVolume
    {
        return new IssueVolume(
            $volume['id'],
            $volume['name'],
            $volume['api_detail_url'],
            $volume['site_detail_url'],
        );
    }
}