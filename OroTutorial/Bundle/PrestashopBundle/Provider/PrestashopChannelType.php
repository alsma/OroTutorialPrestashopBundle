<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;

class PrestashopChannelType implements ChannelInterface
{
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'Prestashop'; // this string will be translated via symfony's translator
    }
}
