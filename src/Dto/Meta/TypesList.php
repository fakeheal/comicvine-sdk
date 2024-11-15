<?php

namespace Chronoarc\Comicvine\Dto\Meta;

readonly class TypesList
{

    public function __construct(
        public int   $numberOfTotalResults,
        /** @var Type[] */
        public array $results,
    )
    {

    }
}