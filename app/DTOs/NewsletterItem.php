<?php

namespace App\DTOs;

class NewsletterItem
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public string $url,
        public string $publishedAt,
        public ?string $image_url 
    ) {}
}
