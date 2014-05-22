<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Oro\Bundle\IntegrationBundle\Provider\AbstractConnector;

class CustomerConnector extends AbstractConnector
{
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'Customers'; // this string will be translated via symfony's translator
    }

    /**
     * {@inheritdoc}
     */
    public function getImportEntityFQCN()
    {
        return 'OroTutorial\Bundle\PrestashopBundle\Entity\Customer';
    }

    /**
     * {@inheritdoc}
     */
    public function getImportJobName()
    {
        // TODO: Implement getImportJobName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    protected function getConnectorSource()
    {
        // TODO: Implement getConnectorSource() method.
    }
}
