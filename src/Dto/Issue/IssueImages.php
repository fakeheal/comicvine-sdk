<?php

namespace Chronoarc\Comicvine\Dto\Issue;

class IssueImages
{
    public function __construct(
        public ?string $iconUrl,
        public ?string $mediumUrl,
        public ?string $screenUrl,
        public ?string $screenLargeUrl,
        public ?string $smallUrl,
        public ?string $superUrl,
        public ?string $thumbUrl,
        public ?string $tinyUrl,
        public ?string $originalUrl,
        public ?string $imageTags,
    )
    {
    }

    public static function fromArray($image): IssueImages
    {
        return new IssueImages(
            $image['icon_url'],
            $image['medium_url'],
            $image['screen_url'],
            $image['screen_large_url'],
            $image['small_url'],
            $image['super_url'],
            $image['thumb_url'],
            $image['tiny_url'],
            $image['original_url'],
            $image['image_tags'],
        );
    }
}