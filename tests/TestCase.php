<?php

namespace Mydnic\ChangelogCommitForLaravel\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mydnic\\ChangelogCommitForLaravel\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ChangelogCommitForLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_changelog-commit-for-laravel_table.php.stub';
        $migration->up();
        */
    }
}
