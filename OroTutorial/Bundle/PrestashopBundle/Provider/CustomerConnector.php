<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Symfony\Bridge\Doctrine\RegistryInterface;

use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\IntegrationBundle\Entity\Status;
use Oro\Bundle\IntegrationBundle\Provider\AbstractConnector;
use Oro\Bundle\IntegrationBundle\Logger\LoggerStrategy;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorContextMediator;

class CustomerConnector extends AbstractConnector
{
    /** @var RegistryInterface */
    protected $registry;

    /**
     * @param ContextRegistry          $contextRegistry
     * @param LoggerStrategy           $logger
     * @param ConnectorContextMediator $contextMediator
     * @param RegistryInterface        $registry
     */
    public function __construct(
        ContextRegistry $contextRegistry,
        LoggerStrategy $logger,
        ConnectorContextMediator $contextMediator,
        RegistryInterface $registry)
    {
        parent::__construct($contextRegistry, $logger, $contextMediator);
        $this->registry = $registry;
    }

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
        return 'prestashop_customer_import';
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
        return $this->transport->getCustomers($this->getLastSyncDate());
    }

    /**
     * @return \DateTime|null
     */
    protected function getLastSyncDate()
    {
        $channel = $this->contextMediator->getChannel($this->getContext());
        $status  = $this->registry->getRepository('OroIntegrationBundle:Channel')
            ->getLastStatusForConnector($channel, $this->getType(), Status::STATUS_COMPLETED);

        return $status ? $status->getDate() : null;
    }
}
