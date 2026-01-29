<?php
declare(strict_types=1);

namespace MyApp\Test;

use BEdita\API\TestSuite\IntegrationTestCase as IntegrationTestCaseBase;

/**
 * Base class for API integration tests.
 */
abstract class IntegrationTestCase extends IntegrationTestCaseBase
{
    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [];

    /**
     * The required fixtures for authentication.
     * They are added to fixtures present in test case class
     *
     * @var array<string>
     */
    protected array $authFixtures = [
        'app.Applications',
        'app.ObjectTypes',
        'app.Objects',
        'app.Profiles',
        'app.Users',
        'app.Roles',
        'app.RolesUsers',
        'app.PropertyTypes',
        'app.Properties',
    ];

    /**
     * Default user used for authentication
     *
     * @var array<string, string>
     */
    protected array $defaultUser = [
        'username' => 'gustavo-admin',
        'password' => 'supporto',
    ];
}
