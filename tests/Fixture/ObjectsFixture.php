<?php
declare(strict_types=1);

namespace MyApp\Test\Fixture;

use Cake\Database\Driver\Postgres;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * ObjectsFixture
 */
class ObjectsFixture extends TestFixture
{
    /**
     * Records
     *
     * @var array
     */
    public array $records = [
        // 1
        [
            'object_type_id' => 2,
            'status' => 'on',
            'uname' => 'gustavo-admin',
            'locked' => 1,
            'deleted' => 0,
            'created' => '2026-01-29 07:09:23',
            'modified' => '2026-01-29 07:09:23',
            'title' => 'Gustavo Admin',
            'lang' => 'it',
            'created_by' => 1,
            'modified_by' => 1,
        ],
    ];

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        parent::init();

        // remove `objects_createdby_fk` and `objects_modifiedby_fk` constraints
        // to avoid PostgreSQL error inserting first user that references itself.
        // CakePHP inserting fixture disables constraints but
        // when the constraints are enabled again PostgreSQL give an SQL error.
        $connection = ConnectionManager::get($this->connection());
        if (!$connection->getDriver() instanceof Postgres) {
            return;
        }

        $constraints = $this->_schema->constraints();
        $removeConstraints = ['objects_createdby_fk', 'objects_modifiedby_fk'];
        if (empty(array_intersect($constraints, $removeConstraints))) {
            return;
        }

        $restoreConstraints = [];
        foreach ($this->_schema->constraints() as $name) {
            if (in_array($name, $removeConstraints)) {
                continue;
            }

            $restoreConstraints[$name] = $this->_schema->getConstraint($name);
            $this->_schema->dropConstraint($name);
        }

        $dropConstraintSql = $this->_schema->dropConstraintSql($connection);
        foreach ($dropConstraintSql as $sql) {
            $connection->execute($sql);
        }

        foreach ($restoreConstraints as $name => $attrs) {
            $this->_schema->addConstraint($name, $attrs);
        }
    }
}
