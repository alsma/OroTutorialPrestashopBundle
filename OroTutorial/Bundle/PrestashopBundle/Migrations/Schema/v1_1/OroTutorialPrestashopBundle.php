<?php

namespace OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_1;

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
        self::restTransportTable($schema);
    }

    /**
     * Generate table oro_integration_transport
     *
     * @param Schema $schema
     */
    public static function restTransportTable(Schema $schema)
    {
        $table = $schema->getTable('oro_integration_transport');
        $table->addColumn('prestashop_rest_endpoint', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('prestashop_rest_api_key', 'string', ['notnull' => false, 'length' => 255]);
    }
}
