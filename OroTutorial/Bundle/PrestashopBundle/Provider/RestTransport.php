<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

class RestTransport implements TransportInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(Transport $settings)
    {
        // TODO: Implement init() method.
    }

    /**
     * {@inheritdoc}
     */
    public function call($action, $params = [])
    {
        // TODO: Implement call() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'REST'; // this string will be translated via symfony's translator
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsFormType()
    {
        return 'oro_tutorials_prestashop_form_rest_transport_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsEntityFQCN()
    {
        return 'OroTutorial\Bundle\PrestashopBundle\Entity\RestTransport';
    }
}
