<?php

namespace App\DTO;

readonly class Repository
{
    public function __construct(
        public string $id,
        public string $name,
        public string $full_name,
        public bool $private,
        public string $html_url,
        public ?string $description,
        public bool $fork,
        public string $contributors_url,
        public ?string $homepage,
        public ?int $forks_count,
        public ?int $stargazers_count,
        public ?int $open_issues_count,
        public bool $is_template,
        public array $topics,
        public bool $archived,
        public string $default_branch,
    ) {}
}
