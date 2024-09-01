<?php

namespace Mydnic\ChangelogCommitForLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel;

class FetchGithubCommitCommand extends Command
{
    protected $signature = 'changelog:fetch';

    protected $description = 'Fetch the latest commits from the GitHub repositories and store them in the database.';

    public function handle(): void
    {
        $commits = $this->fetchCommits();
        $commits = ChangelogCommitForLaravel::prepareCommits($commits);

        $this->info('Found ' . $commits->count() . ' commits.');

        foreach ($commits as $commitMessage) {
            // Skip if the commit already exists
            if (
                DB::table(config('changelog-commit-for-laravel.table_name'))
                ->where('commit_url', $commitMessage['commit_url'])
                ->exists()
            ) {
                continue;
            }

            // Insert the commit message
            DB::table(config('changelog-commit-for-laravel.table_name'))->insert($commitMessage);
            $this->info('Inserted commit: ' . $commitMessage['commit_url']);
        }

        $this->info('Done.');
    }

    public function fetchCommits(): Collection
    {
        $commits = collect();

        foreach (config('changelog-commit-for-laravel.github_repositories') as $repository) {
            $commits->push(
                Http::withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'Authorization' => 'Bearer ' . config('changelog-commit-for-laravel.github_access_token'),
                    'X-GitHub-Api-Version' => '2022-11-28',
                ])
                    ->get('https://api.github.com/repos/' . $repository . '/commits')
                    ->json()
            );
        }

        return $commits;
    }
}