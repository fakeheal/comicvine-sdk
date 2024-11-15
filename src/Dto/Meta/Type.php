<?php

namespace Chronoarc\Comicvine\Dto\Meta;

readonly class Type
{

    public function __construct(
        public int $id,
        public string $detailResourceName,
        public string $listResourceName,

    )
    {

    }
}