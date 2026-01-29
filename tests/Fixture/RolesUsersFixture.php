<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture for `roles_users` table.
 */
class RolesUsersFixture extends TestFixture
{
    /**
     * @inheritDoc
     */
    public array $records = [
        [
            'role_id' => 1,
            'user_id' => 1,
        ],
    ];
}
