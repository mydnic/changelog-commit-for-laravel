<?php

namespace Mydnic\ChangelogCommitForLaravel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    use HasFactory;

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('changelog-commit-for-laravel.table_name');
    }

    public static function groupedByDate()
    {
        return self::select(['message', 'date'])
            ->latest('id')
            ->paginate(request()->get('per_page', 50));
    }
}
