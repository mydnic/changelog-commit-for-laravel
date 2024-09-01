<?php

namespace Mydnic\ChangelogCommitForLaravel\Commands;

use Illuminate\Console\Command;

class ChangelogCommitForLaravelCommand extends Command
{
    public $signature = 'changelog-commit-for-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
