# BEdita API template

[![Github Actions](https://github.com/bedita/api-template/workflows/php/badge.svg)](https://github.com/bedita/api-template/actions?query=workflow%3Aphp)
[![codecov](https://codecov.io/gh/bedita/api-template/branch/master/graph/badge.svg)](https://codecov.io/gh/bedita/api-template)

This is the skeleton app to build BEdita5 API projects.

## Requirements

1. PHP >= 8.1
2. Download latest [Composer](https://getcomposer.org/doc/00-intro.md) or update via `composer self-update`.

## Installation

Simply run

```bash
composer create-project bedita/api-template
```

In case you want to use a custom app dir name (e.g. `myapp/`):

```bash
composer create-project bedita/api-template myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server
```

Then visit `http://localhost:8765` to see the welcome page.

## Configuration

Review and edit accordingly every configuration item in  `config/app_local.php`.
Make sure at least `Datasources` points to the desired DB instance.

## Namespace

You need to manually change the default `MyApp` namespace in order to use a custom one (recommended before any application logic is introduced).

Files referencing `MyApp` are:

* `composer.json`
* `bin/cake.php`
* `config/app.php` or override in `config/app_local.php`
* `src/Console/installer.php`
* `src/Shell/ConsoleShell.php`
* `Application.php` (and `test/TestCase/ApplicationTest.php`)
* `webroot/index.php`

Make sure to launch `composer dump-autoload` after this manual change in order to update autoloader data
