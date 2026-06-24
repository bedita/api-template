#!/bin/sh
set -e

RUNTIME_LIMITS_INI=/usr/local/etc/php/conf.d/zz-runtime-limits.ini

{
	if [ -n "${PHP_MEMORY_LIMIT:-}" ]; then
		printf 'memory_limit=%s\n' "$PHP_MEMORY_LIMIT"
	fi
	if [ -n "${PHP_POST_MAX_SIZE:-}" ]; then
		printf 'post_max_size=%s\n' "$PHP_POST_MAX_SIZE"
	fi
	if [ -n "${PHP_UPLOAD_MAX_FILESIZE:-}" ]; then
		printf 'upload_max_filesize=%s\n' "$PHP_UPLOAD_MAX_FILESIZE"
	fi
} > "$RUNTIME_LIMITS_INI"

echo "PHP memory_limit effective: $(php -r 'echo ini_get("memory_limit");')" >&2

composer run migrate

php --version

# Operations performed:
# 1. export environment variables to /etc/container.env
# 2. setup cron jobs in /etc/cron.d/cronjobs
php /setup-cron.php

chown -R www-data:www-data /var/www/html/webroot/_files /var/www/html/tmp /var/www/html/logs

exec "$@"
