# Automatic Changelog Generator for Laravel Applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mydnic/changelog-commit-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mydnic/changelog-commit-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mydnic/changelog-commit-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mydnic/changelog-commit-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mydnic/changelog-commit-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mydnic/changelog-commit-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mydnic/changelog-commit-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mydnic/changelog-commit-for-laravel)

Automatically generate a changelog inside your Laravel App based on your commit descriptions.

## Introduction

When building a web project, it's important to let your users know what changed in each release, or even as soon as a bug is fixed. You might do that through a blog post, or on social media, but it's still a manual process.

This package will automatically generate a changelog based on your commit descriptions. It will fetch the commit history from your repository and store the messages from your commit descriptions in a database table.

You can then display the changelog in your app, or even send it to your users via email.

## How it works

### Write your commit messages

Here's an example of a commit message:

```
feat: fix issue with authentication

> You can now login without any issue
> Enjoy!
```

As you can see, the commit message is composed of several lines. The first line is your usual commit message. The other lines can be used to add more details about the commit.

But only the other lines starting with `>` will be used to generate the changelog.

### Generate the changelog

After you've pushed your commits, you can run the following command to generate the changelog:

```bash
php artisan changelog:generate
```

This will fetch the commit history from your repository and store the messages (all lines starting with `>`) from your commit descriptions in a database table.

### Showing the changelog

You can then display the changelog in your app, or even send it to your users via email.

Here's an example of how to display the changelog in your app:

```php
$changelog = \Mydnic\ChangelogCommitForLaravel\Models\Changelog::all();

// Grouped by date
$changelog = \Mydnic\ChangelogCommitForLaravel\Models\Changelog::groupByDate();
```


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

```php
$changelogCommitForLaravel = new Mydnic\ChangelogCommitForLaravel();
echo $changelogCommitForLaravel->echoPhrase('Hello, Mydnic!');
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
