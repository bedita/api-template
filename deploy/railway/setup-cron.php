<?php
/**
 * Setup cron jobs from CRON_JOBS environment variable
 *
 * This script reads the CRON_JOBS environment variable (JSON array)
 * and creates a cron file at /etc/cron.d/cronjobs with one job per line.
 *
 * Usage: php setup-cron.php
 *
 * Environment variable example:
 * CRON_JOBS='["* * * * * www-data . /etc/container.env && /var/www/html/bin/cake jobs pending > /dev/null 2>&1", "0 5 * * * www-data . /etc/container.env && /var/www/html/bin/cake streams removeOrphans > /dev/null 2>&1"]'
 */

function exportEnvironmentVariables(): int
{
    $envFile = '/etc/container.env';
    echo "Exporting environment variables to $envFile...\n";

    $content = '';
    foreach ($_ENV as $key => $value) {

        if (
            str_starts_with($key, 'CRON_JOBS') ||
            str_starts_with($key, 'PHP_') ||
            str_starts_with($key, 'RAILWAY_')
        ) {
            continue;
        }
        // Escape special characters including newlines for bash
        $value = str_replace(
            ["\n", "\r", '"', "\\", "\$", "`"],
            ["\\n", "\\r", '\"', "\\\\", "\\\$", "\\`"],
            $value
        );
        $content .= "export $key=\"$value\"\n";
    }

    if (file_put_contents($envFile, $content) === false) {
        fwrite(STDERR, "Failed to write environment file: $envFile\n");
        return 1;
    }

    if (!chmod($envFile, 0644)) {
        fwrite(STDERR, "Failed to set permissions on environment file: $envFile\n");
        return 1;
    }

    $varCount = count($_ENV);
    echo "Exported $varCount environment variables to $envFile\n";

    return 0;
}

function setupCronJobs(): int
{
    $cronJobsJson = getenv('CRON_JOBS');

    if (empty($cronJobsJson)) {
        echo "No CRON_JOBS environment variable found, skipping cron setup.\n";
        return 0;
    }

    echo "Setting up cron jobs...\n";

    // Parse JSON array
    $jobs = json_decode($cronJobsJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        fwrite(STDERR, "Error parsing CRON_JOBS: " . json_last_error_msg() . "\n");
        return 1;
    }

    if (!is_array($jobs)) {
        fwrite(STDERR, "CRON_JOBS must be a JSON array\n");
        return 1;
    }

    if (empty($jobs)) {
        echo "CRON_JOBS is empty, no cron jobs to setup.\n";
        return 0;
    }

    // Create cron file content
    $cronFile = '/etc/cron.d/cronjobs';
    $content = '';

    foreach ($jobs as $job) {
        if (!is_string($job) || empty(trim($job))) {
            fwrite(STDERR, "Invalid cron job entry found, skipping: " . var_export($job, true) . "\n");
            continue;
        }
        $content .= trim($job) . "\n";
    }

    if (empty($content)) {
        fwrite(STDERR, "No valid cron jobs found\n");
        return 1;
    }

    // Write cron file
    if (file_put_contents($cronFile, $content) === false) {
        fwrite(STDERR, "Failed to write cron file: $cronFile\n");
        return 1;
    }

    // Set proper permissions
    if (!chmod($cronFile, 0644)) {
        fwrite(STDERR, "Failed to set permissions on cron file: $cronFile\n");
        return 1;
    }

    $jobCount = count(array_filter(explode("\n", trim($content))));
    echo "Created $jobCount cron jobs in $cronFile\n";
    echo "Cron jobs setup completed.\n";

    return 0;
}

// Run the setup
$exitCode = exportEnvironmentVariables();
if ($exitCode !== 0) {
    exit($exitCode);
}

exit(setupCronJobs());
