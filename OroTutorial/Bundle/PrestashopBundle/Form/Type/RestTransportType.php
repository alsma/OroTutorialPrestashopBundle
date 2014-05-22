<?php

namespace OroTutorial\Bundle\PrestashopBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use OroTutorial\Bundle\PrestashopBundle\Provider\RestTransport;

class RestTransportType extends AbstractType
{
    const NAME = 'oro_tutorial_prestashop_form_rest_transport_type';

    /** @var RestTransport */
    protected $transport;

    /**
     * @param RestTransport $transport
     */
    public function __construct(RestTransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'endpoint',
            'text',
            ['label' => 'Endpoint', 'required' => true]
        );
        $builder->add(
            'apiKey',
            'password',
            ['label' => 'Api Key', 'required' => true]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => $this->transport->getSettingsEntityFQCN()]);
    }
}
