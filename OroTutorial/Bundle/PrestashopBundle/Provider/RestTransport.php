<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

use OroTutorial\Bundle\PrestashopBundle\Form\Type\RestTransportType;

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
        return RestTransportType::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsEntityFQCN()
    {
        return 'OroTutorial\Bundle\PrestashopBundle\Entity\RestTransport';
    }
}
