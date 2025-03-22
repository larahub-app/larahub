<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class PubliclyAvailbleGitHubRepo implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // validate that the url is a github repo
        if (! preg_match('/^https:\/\/github\.com\/[^\/]+\/[^\/]+$/', $value)) {
            $fail('The :attribute must be a valid GitHub repository URL.');
        }

        // validate that the repo is publicly available
        $response = Http::get($value);

        if ($response->status() !== 200) {
            $fail('The :attribute must be a publicly available GitHub repository.');
        }
    }
}
