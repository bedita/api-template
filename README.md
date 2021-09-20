# BEdita API template

This is the skeleton app to build BEdita4 API projects.

## Requirements

1. PHP >= 7.2
1. Download latest [Composer](https://getcomposer.org/doc/00-intro.md) or update via `composer self-update`.

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
* `Application.php` (and `test/TestCase/ApplicationTest.php`)
* `webroot/index.php`
