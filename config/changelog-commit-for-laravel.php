<?php

// config for Mydnic/ChangelogCommitForLaravel
return [
    /**
     * The name of the table to store the changelog in.
     */
    'table_name' => 'changelog',

    /**
     * The GitHub access token to use to fetch the commit history.
     */
    'github_access_token' => env('GITHUB_ACCESS_TOKEN'),

    /**
     * The GitHub repositories to fetch the commit history from.
     */
    'github_repositories' => [
        'mydnic/changelog-commit-for-laravel', // change me
        // other repositories if you want to fetch the commit history from multiple repositories
        // To specify a branch, make it an array like this one below:
        // [ 'mydnic/changelog-commit-for-laravel', 'main' ]
    ],
];
