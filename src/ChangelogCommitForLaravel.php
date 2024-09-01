<?php

namespace Mydnic\ChangelogCommitForLaravel;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ChangelogCommitForLaravel
{
    public static function prepareCommits(Collection $commits): Collection
    {
        return $commits->map(function ($commit) {
            $commitMessage = $commit['commit']['message'];

            // Check if the commit message contains a double newline
            if (($pos = strpos($commitMessage, "\n\n")) !== false) {
                // only take lines that start with ">"
                $detailedMessages = collect(explode("\n", $commitMessage))
                    ->filter(function ($line) {
                        return Str::startsWith($line, '>');
                    })
                    ->map(function ($line) {
                        return trim($line, '> ');
                    })
                    ->implode("\n");

                return [
                    'commit_url' => $commit['html_url'],
                    'message' => $detailedMessages,
                    'date' => $commit['commit']['author']['date'],
                ];
            }

            return null;
        })->filter();
    }
}
