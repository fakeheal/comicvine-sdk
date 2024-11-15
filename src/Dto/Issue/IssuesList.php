<?php

namespace Chronoarc\Comicvine\Dto\Issue;

class IssuesList
{
    public function __construct(
        public int   $numberOfTotalResults,
        /** @var Issue[] */
        public array $results,
    )
    {

    }
}