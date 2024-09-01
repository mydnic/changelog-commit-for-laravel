# Automatic Changelog Generator for Laravel Applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mydnic/changelog-commit-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mydnic/changelog-commit-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mydnic/changelog-commit-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mydnic/changelog-commit-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mydnic/changelog-commit-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mydnic/changelog-commit-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mydnic/changelog-commit-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mydnic/changelog-commit-for-laravel)

Automatically generate a changelog for your users inside your Laravel App based on your commit descriptions.

## Introduction

When building a web project, it's important to let your users know what changed in each release, or even as soon as a bug is fixed. You might do that through a blog post, or on social media, but it's still a manual process.

This package will automatically generate a changelog based on your commit descriptions. It will fetch the commit history from your repository and store the messages from your commit descriptions in a database table.

You can then display the changelog in your app, or even send it to your users via email.


## Installation

You can install the package via composer:

```bash
composer require mydnic/changelog-commit-for-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="changelog-commit-for-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="changelog-commit-for-laravel-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * The name of the table to store the changelog in.
     */
    'table_name' => 'changelogs',

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
    ],
];
```

## Usage

Once the package is installed on your project, you should add the `changelod:fetch` command to your deployment process.

Now, every time your application is deployed, the changelog will be updated with the latest commit messages.


### Write your commit messages

Here's an example of a commit message:

```
fix: issue with authentication

> You can now login without any issue
> Enjoy!
```

As you can see, the commit message is composed of several lines. The first line is your usual commit message. The other lines can be used to add more details about the commit.

But only the other lines starting with `>` will be used to generate the changelog.

### Generate the changelog

After you've pushed your commits, you can run the following command to fetch the commit history.
Or you can add this command to your deployment process so you don't have to run it manually.

```bash
php artisan changelog:fetch
```

This will fetch the commit history from your repository and store the messages (all lines starting with `>`) from your commit descriptions in a database table.

### Showing the changelog

You can then display the changelog in your app, or even send it to your users via email.

Here's an example of how to display the changelog in your app:

Use the `Changelog` model to fetch the changelog entries in your application.

```php
use Mydnic\ChangelogCommitForLaravel\Models\Changelog;

$changelogs = Changelog::latest()->paginate(50);

return view('changelog', compact('changelogs'));
// or return JSON response
return response()->json($changelogs);
```

### Front End Examples

Please submit more examples if you have any!

#### VueJS Component

```vue
<template>
    <div>
        <div
            v-for="date in Object.keys(groupedChangelog)"
            :key="date"
        >
            <h2 class="text-lg font-semibold text-gray-800 mt-5 mb-1 capitalize">
                {{ $filters.format(date, 'dddd DD MMM YYYY') }}
            </h2>
            <ul class="list-disc pl-4 text-gray-600 space-y-1">
                <li
                    v-for="item in groupedChangelog[date]"
                    :key="item.message"
                    class="text-sm"
                >
                    {{ item.message }}
                </li>
            </ul>
        </div>

        <div
            v-if="pagination.last_page > pagination.current_page"
            class="text-center mt-10"
        >
            <button
                class="btn btn-sm"
                :class="{ loading: isLoading }"
                :disabled="isLoading"
                @click="loadMore"
            >
                Load more...
            </button>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    data () {
        return {
            changelog: [],
            pagination: {}
        }
    },

    computed: {
        groupedChangelog () {
            return this.changelog.reduce((acc, item) => {
                const key = item.date
                if (!acc[key]) {
                    acc[key] = []
                }
                acc[key].push(item)
                return acc
            }, {})
        }
    },

    created () {
        this.getChangelog()
    },

    methods: {
        getChangelog (page = 1) {
            fetch('https://your-app.example/api/changelog?page=' + page)
                .then(response => response.json())
                .then((data) => {
                    this.changelog = [...this.changelog, ...data.data]
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page
                    }
                })
        },

        loadMore () {
            this.getChangelog(this.pagination.current_page + 1)
        }
    }
})
</script>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Clément Rigo](https://github.com/mydnic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
