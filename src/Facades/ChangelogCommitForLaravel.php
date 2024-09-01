<?php

namespace Mydnic\ChangelogCommitForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel
 */
class ChangelogCommitForLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mydnic\ChangelogCommitForLaravel\ChangelogCommitForLaravel::class;
    }
}
