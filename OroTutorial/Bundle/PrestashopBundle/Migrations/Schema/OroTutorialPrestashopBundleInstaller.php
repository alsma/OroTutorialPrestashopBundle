<?php

namespace OroTutorial\Bundle\PrestashopBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\MigrationBundle\Migration\Installation;

use OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_0\OroTutorialPrestashopBundle as v1_0;
use OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_1\OroTutorialPrestashopBundle as v1_1;
use OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_2\OroTutorialPrestashopBundle as v1_2;

class OroTutorialPrestashopBundleInstaller implements Installation
{
    /**
     * @inheritdoc
     */
    public function getMigrationVersion()
    {
        return 'v1_2';
    }

    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        v1_0::customerTable($schema);
        v1_1::restTransportTable($schema);
        v1_2::addContactAndAccountRelations($schema);
    }
}
