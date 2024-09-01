<?php

namespace Mydnic\ChangelogCommitForLaravel;

use Mydnic\ChangelogCommitForLaravel\Commands\ChangelogCommitForLaravelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ChangelogCommitForLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('changelog-commit-for-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_changelog_commit_for_laravel_table')
            ->hasCommand(ChangelogCommitForLaravelCommand::class);
    }
}
