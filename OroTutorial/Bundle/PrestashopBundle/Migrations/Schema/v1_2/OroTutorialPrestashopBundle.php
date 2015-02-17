<?php

namespace OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_2;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class OroTutorialPrestashopBundle implements Migration
{
    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        self::addContactAndAccountRelations($schema);
    }

    /**
     * Add contact and account relations
     *
     * @param Schema $schema
     */
    public static function addContactAndAccountRelations(Schema $schema)
    {
        $table = $schema->getTable('ot_prestashop_customer');
        $table->addColumn('contact_id', 'integer', ['notnull' => false]);
        $table->addColumn('account_id', 'integer', ['notnull' => false]);
        $table->addIndex(['contact_id'], 'IDX_A8671CD1E7A1254A', []);
        $table->addIndex(['account_id'], 'IDX_A8671CD19B6B5FBA', []);

        /** Generate foreign keys for table contacts and accounts **/
        $table = $schema->getTable('ot_prestashop_customer');
        $table->addForeignKeyConstraint(
            $schema->getTable('orocrm_contact'),
            ['contact_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('orocrm_account'),
            ['account_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );
        /** End of generate foreign keys for table contacts and accounts **/
    }
}
