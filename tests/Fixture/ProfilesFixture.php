<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture for `profiles` table.
 */
class ProfilesFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        [
            'id' => 1,
            'name' => 'Gustavo',
            'surname' => 'Admin',
            'email' => 'gustavo-admin@example.com',
        ],
    ];
}
