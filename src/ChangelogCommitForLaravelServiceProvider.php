<?php

namespace Mydnic\ChangelogCommitForLaravel;

use Mydnic\ChangelogCommitForLaravel\Commands\FetchGithubCommitCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
            ->hasCommand(FetchGithubCommitCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations();
            });;
    }
}
