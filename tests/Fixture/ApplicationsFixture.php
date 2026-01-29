<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
 */
class ApplicationsFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'api_key' => API_KEY,
            'client_secret' => null,
            'name' => 'my_webapp',
            'created' => '2026-01-29 07:10:57',
            'modified' => '2026-01-29 07:10:57',
            'enabled' => 1,
        ],
    ];
}
