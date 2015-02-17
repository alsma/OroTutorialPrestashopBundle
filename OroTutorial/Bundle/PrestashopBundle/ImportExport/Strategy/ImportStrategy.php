<?php

namespace OroTutorial\Bundle\PrestashopBundle\ImportExport\Strategy;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

use Doctrine\Common\Util\ClassUtils;

use Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy;

class ImportStrategy extends ConfigurableAddOrReplaceStrategy implements
    LoggerAwareInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeProcessEntity($entity)
    {
        if ($this->logger) {
            $this->logger->info('Syncing PrestaShop Customer [origin_id=' . $entity->getRemoteId() . ']');
        }

        return parent::beforeProcessEntity($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function process($entity)
    {
        $this->assertEnvironment($entity);

        $this->cachedEntities = array();
        $entity = $this->beforeProcessEntity($entity);
        $entity = $this->processEntity($entity, false, true, $this->context->getValue('itemData'));
        $entity = $this->afterProcessEntity($entity);
        $entity = $this->validateAndUpdateContext($entity);

        return $entity;
    }

    /**
     * {@inheritdoc}
     */
    protected function findExistingEntity($entity, array $searchContext = array())
    {
        $entityName = ClassUtils::getClass($entity);
        $existingEntity = null;

        // find by identity fields
        if (!$searchContext || $this->databaseHelper->getIdentifier(current($searchContext))
        ) {
            $identityValues = $searchContext;
            $identityValues += $this->fieldHelper->getIdentityValues($entity);
            // add channel filter for finding existing entity
            $identityValues += ['channel' => $entity->getChannel()];
            $existingEntity = $this->findEntityByIdentityValues($entityName, $identityValues);
        }

        return $existingEntity;
    }
}
