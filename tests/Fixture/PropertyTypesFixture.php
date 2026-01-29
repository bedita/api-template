<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use stdClass;

/**
 * Fixture for `property_types` table.
 */
class PropertyTypesFixture extends TestFixture
{
    /**
     * @inheritDoc
     */
    public string $table = 'property_types';

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->records = [
            // 1
            [
                'name' => 'string',
                'params' => ['type' => 'string'],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 2
            [
                'name' => 'text',
                'params' => [
                    'type' => 'string',
                    'contentMediaType' => 'text/html',
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 3
            [
                'name' => 'status',
                'params' => [
                    'type' => 'string',
                    'enum' => ['on', 'off', 'draft'],
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 4
            [
                'name' => 'email',
                'params' => [
                    'type' => 'string',
                    'format' => 'email',
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 5
            [
                'name' => 'url',
                'params' => [
                    'type' => 'string',
                    'format' => 'uri',
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 6
            [
                'name' => 'date',
                'params' => [
                    'type' => 'string',
                    'format' => 'date',
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 7
            [
                'name' => 'datetime',
                'params' => [
                    'type' => 'string',
                    'format' => 'date-time',
                ],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 8
            [
                'name' => 'number',
                'params' => ['type' => 'number'],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 9
            [
                'name' => 'integer',
                'params' => ['type' => 'integer'],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 10
            [
                'name' => 'boolean',
                'params' => ['type' => 'boolean'],
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 11
            [
                'name' => 'json',
                'params' => new stdClass(),
                'created' => '2025-11-01 09:23:43',
                'modified' => '2025-11-01 09:23:43',
                'core_type' => true,
            ],
            // 12
            [
                'name' => 'unused property type',
                'params' => [
                    'type' => 'object',
                    'properties' => [
                        'gustavo' => ['const' => 'supporto'],
                    ],
                    'required' => ['gustavo'],
                ],
                'created' => '2025-11-02 09:23:43',
                'modified' => '2025-11-02 09:23:43',
                'core_type' => false,
            ],
            // 13
            [
                'name' => 'children_order',
                'params' => [
                    'type' => 'string',
                    'enum' => [
                        'position',
                        '-position',
                        'title',
                        '-title',
                        'created',
                        '-created',
                        'modified',
                        '-modified',
                        'publish_start',
                        '-publish_start',
                    ],
                ],
                'created' => '2022-12-01 15:35:21',
                'modified' => '2022-12-01 15:35:21',
                'core_type' => true,
            ],
        ];

        parent::init();
    }
}
