<?php

function normalizeLineEndings($string)
{
    return str_replace("\r\n", "\n", $string);
}

it('correctly fetches the message from a commit', function () {
    $commitMessage = [
        'branch' => 'main',
        'github' => [
            'html_url' => 'https://github.com/mydnic/changelog-commit-for-laravel/commit/123',
            'commit' => [
                'author' => [
                    'date' => '2021-01-01T00:00:00Z',
                ],
                'message' => normalizeLineEndings(<<<'EOF'
feat: fix issue with authentication

> You can now login without any issue
> Enjoy!
EOF
                ),
            ],
        ],
    ];

    $result = \Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel::prepareCommits(collect([$commitMessage]));

    expect($result[0])->toHaveKeys(['commit_url', 'message', 'date']);
    expect($result[0]['message'])->toContain('You can now login without any issue');
    expect($result[0]['message'])->toContain('Enjoy!');
});

it('ignores messages without a correctly formatted commit message', function () {
    $commitMessage = [
        'branch' => 'main',
        'github' => [
            'html_url' => 'https://github.com/mydnic/changelog-commit-for-laravel/commit/123',
            'commit' => [
                'author' => [
                    'date' => '2021-01-01T00:00:00Z',
                ],
                'message' => normalizeLineEndings(<<<'EOF'
feat: fix issue with authentication

Refactor the code
EOF
                ),
            ],
        ],
    ];

    $result = \Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel::prepareCommits(collect([$commitMessage]));

    expect($result)->toHaveCount(0);
});

it('ignores messages without a correctly formatted commit message but keep good ones', function () {
    $badcommitMessage = [
        'branch' => 'main',
        'github' => [
            'html_url' => 'https://github.com/mydnic/changelog-commit-for-laravel/commit/123',
            'commit' => [
                'author' => [
                    'date' => '2021-01-01T00:00:00Z',
                ],
                'message' => normalizeLineEndings(<<<'EOF'
feat: fix issue with authentication

Refactor the code
EOF
                ),
            ],
        ],
    ];

    $commitMessage2 = [
        'branch' => 'main',
        'github' => [
            'html_url' => 'https://github.com/mydnic/changelog-commit-for-laravel/commit/123',
            'commit' => [
                'author' => [
                    'date' => '2021-01-01T00:00:00Z',
                ],
                'message' => normalizeLineEndings(<<<'EOF'
feat: fix issue with authentication

> You can now login without any issue
> Enjoy!
EOF
                ),
            ],
        ],
    ];

    $result = \Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel::prepareCommits(collect([$badcommitMessage, $commitMessage2]));

    expect($result)->toHaveCount(1);
    expect($result[0]['message'])->toContain('You can now login without any issue');
    expect($result[0]['message'])->toContain('Enjoy!');
});
