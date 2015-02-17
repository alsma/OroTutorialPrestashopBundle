<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider;

use Symfony\Component\HttpFoundation\ParameterBag;

use Oro\Bundle\IntegrationBundle\Provider\Rest\Transport\AbstractRestTransport;

use OroTutorial\Bundle\PrestashopBundle\Form\Type\RestTransportType;
use OroTutorial\Bundle\PrestashopBundle\Provider\Transport\RestIterator;

class RestTransport extends AbstractRestTransport
{
    const API_URL_PREFIX  = 'api';
    const READ_BATCH_SIZE = 25;

    /**
     * {@inheritdoc}
     */
    protected function getClientBaseUrl(ParameterBag $parameterBag)
    {
        return rtrim($parameterBag->get('endpoint'), '/') . '/' . ltrim(self::API_URL_PREFIX, '/');
    }

    /**
     * {@inheritdoc}
     */
    protected function getClientOptions(ParameterBag $parameterBag)
    {
        $key = $parameterBag->get('api_key');
        return [
            'auth' => ["{$key}"]
        ];
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

    /**
     * Get Prestashop customers data.
     *
     * @param \DateTime $lastUpdatedAt
     * @return \Iterator
     * @throws RestException
     */
    public function getCustomers($lastUpdatedAt)
    {
        $params = [
            'output_format' => 'JSON',
            'display'       => 'full',
            'limit'         => self::READ_BATCH_SIZE
        ];
        if ($lastUpdatedAt) {
            $params['date'] = 1;
            $params['filter']['date_upd'] = sprintf(">[%s]", $lastUpdatedAt->format('Y-m-d H:i:s'));
        }

        $customers = new RestIterator($this->getClient(), 'customers', $params);

        return $customers;
    }
}
