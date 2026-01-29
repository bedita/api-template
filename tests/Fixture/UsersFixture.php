<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Authentication\PasswordHasher\LegacyPasswordHasher;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture for `users` table.
 */
class UsersFixture extends TestFixture
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'username' => 'gustavo-admin',
                'password_hash' => (new LegacyPasswordHasher(['hashType' => 'md5']))->hash('supporto'),
                'blocked' => 0,
                'last_login' => null,
                'last_login_err' => null,
                'num_login_err' => 0,
                'verified' => '2026-01-29 11:36:00',
                'password_modified' => '2026-01-29 11:36:00',
            ],
        ];

        parent::init();
    }
}
