<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace MyApp\Test\TestCase;

use MyApp\Test\IntegrationTestCase;

/**
 * UsersTest class. Sample test that uses IntegrationTestCase as base class and fixtures.
 */
class UsersTest extends IntegrationTestCase
{
    /**
     * Test getting admin user.
     *
     * @return void
     */
    public function testAdminUser(): void
    {
        $this->configRequestHeaders('GET', $this->getUserAuthHeader(username: 'gustavo-admin', password: 'supporto'));
        $this->get('/users/1');
        $this->assertResponseOk();
    }
}
