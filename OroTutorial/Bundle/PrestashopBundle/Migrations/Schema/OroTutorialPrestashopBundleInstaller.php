<?php

namespace OroTutorial\Bundle\PrestashopBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\MigrationBundle\Migration\Installation;

use OroTutorial\Bundle\PrestashopBundle\Migrations\Schema\v1_0\OroTutorialPrestashopBundle;

class OroTutorialPrestashopBundleInstaller implements Installation
{
    /**
     * @inheritdoc
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        OroTutorialPrestashopBundle::customerTable($schema);
    }
}
