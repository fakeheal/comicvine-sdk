<?php

namespace Chronoarc\Comicvine\Dto\Issue;

readonly class Issue
{
    public function __construct(
        public ?array      $aliases,
        public ?string     $apiDetailUrl,
        public ?string     $coverDate,
        public ?string     $dateAdded,
        public ?string     $dateLastUpdated,
        public ?string     $deck,
        public ?string     $description,
        public int      $id,
        public IssueImages $image,
        public ?string     $issueNumber,
        public ?string     $name,
        public ?string     $siteDetailUrl,
        public ?string     $storeDate,
        public IssueVolume $volume,
    )
    {

    }

    public static function fromArray($issue): Issue
    {
        return new Issue(
            $issue['aliases'],
            $issue['api_detail_url'],
            $issue['cover_date'],
            $issue['date_added'],
            $issue['date_last_updated'],
            $issue['deck'],
            $issue['description'],
            $issue['id'],
            IssueImages::fromArray($issue['image']),
            $issue['issue_number'],
            $issue['name'],
            $issue['site_detail_url'],
            $issue['store_date'],
            IssueVolume::fromArray($issue['volume'])
        );
    }
}