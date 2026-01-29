<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Fixture for `object_types` table.
 */
class ObjectTypesFixture extends TestFixture
{
    /**
     * @inheritDoc
     */
    public array $records = [
        // 1
        [
            'singular' => 'object',
            'name' => 'objects',
            'is_abstract' => true,
            'parent_id' => null,
            'tree_left' => 1,
            'tree_right' => 24,
            'description' => null,
            'plugin' => 'BEdita/Core',
            'model' => 'Objects',
            'created' => '2025-11-10 09:27:23',
            'modified' => '2025-11-10 09:27:23',
            'enabled' => true,
            'core_type' => true,
            'translation_rules' => null,
            'is_translatable' => false,
        ],
        // 2
        [
            'singular' => 'user',
            'name' => 'users',
            'is_abstract' => false,
            'parent_id' => 1,
            'tree_left' => 6,
            'tree_right' => 7,
            'description' => null,
            'plugin' => 'BEdita/Core',
            'model' => 'Users',
            'created' => '2025-11-10 09:27:23',
            'modified' => '2025-11-10 09:27:23',
            'enabled' => true,
            'core_type' => true,
            'translation_rules' => null,
            'is_translatable' => false,
        ],
        // 3
        [
            'singular' => 'profile',
            'name' => 'profiles',
            'is_abstract' => false,
            'parent_id' => 1,
            'tree_left' => 4,
            'tree_right' => 5,
            'description' => null,
            'associations' => ['Tags'],
            'plugin' => 'BEdita/Core',
            'model' => 'Profiles',
            'created' => '2025-11-10 09:27:23',
            'modified' => '2025-11-10 09:27:23',
            'enabled' => true,
            'core_type' => true,
            'translation_rules' => null,
            'is_translatable' => false,
        ],
    ];
}
