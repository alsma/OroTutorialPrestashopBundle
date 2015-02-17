<?php

namespace OroTutorial\Bundle\PrestashopBundle\ImportExport\Serializer;

use Symfony\Bridge\Doctrine\RegistryInterface;

use Oro\Bundle\ImportExportBundle\Field\FieldHelper;
use Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer;

use OroTutorial\Bundle\PrestashopBundle\Entity\Customer;

class CustomerNormalizer extends ConfigurableEntityNormalizer
{
    /** @var RegistryInterface */
    protected $registry;

    /**
     * @param FieldHelper       $fieldHelper
     * @param RegistryInterface $registry
     */
    public function __construct(FieldHelper $fieldHelper, RegistryInterface $registry)
    {
        parent::__construct($fieldHelper);
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = array())
    {
        return $data instanceof Customer;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null, array $context = array())
    {
        return $type == 'OroTutorial\\Bundle\\PrestashopBundle\\Entity\\Customer';
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        /** @var Customer $customer */
        $customer = parent::denormalize($data, $class, $format, $context);

        $integration = $this->getIntegrationFromContext($context);
        $customer->setChannel($integration);

        return $customer;
    }

    /**
     * @param array $context
     *
     * @return Integration
     * @throws \LogicException
     */
    public function getIntegrationFromContext(array $context)
    {
        if (!isset($context['channel'])) {
            throw new \LogicException('Context should contain reference to channel');
        }

        return $this->registry
            ->getRepository('OroIntegrationBundle:Channel')
            ->getOrLoadById($context['channel']);
    }
}
