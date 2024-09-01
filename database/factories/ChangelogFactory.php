<?php

namespace Mydnic\ChangelogCommitForLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChangelogFactory extends Factory
{
    protected $model = \Mydnic\ChangelogCommitForLaravel\Models\Changelog::class;

    public function definition()
    {
        return [
            'commit_url' => $this->faker->url(),
            'message' => $this->faker->sentence(),
            'date' => $this->faker->date(),
        ];
    }
}
