<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture for `roles` table.
 */
class RolesFixture extends TestFixture
{
    /**
     * @inheritDoc
     */
    public array $records = [
        // 1
        [
            'name' => 'admin',
            'unchangeable' => 1,
            'created' => '2025-12-29 11:36:00',
            'modified' => '2025-12-29 11:36:00',
            'priority' => 0,
        ],
    ];
}
