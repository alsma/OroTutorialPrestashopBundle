<?php

namespace OroTutorial\Bundle\PrestashopBundle\Provider\Transport;

use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\AbstractRestIterator;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\RestClientInterface;

class RestIterator extends AbstractRestIterator
{
    /**
     * @var string
     */
    protected $resource;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var string|null
     */
    protected $nextPageUrl;

    /**
     * @param RestClientInterface $client
     * @param string $resource
     * @param array $params
     */
    public function __construct(RestClientInterface $client, $resource, array $params = [])
    {
        parent::__construct($client);
        $this->resource = $resource;
        $this->params = $params;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadPage(RestClientInterface $client)
    {
        $limits = explode(',', $this->params['limit']);
        $pageSize = array_pop($limits);
        if ($this->firstLoaded) {
            if ($this->totalCount < $pageSize) {
                return null;
            }
            if (empty($limits)) {
                $limits = [$pageSize, $pageSize];
            } else {
                $limits[0] += $pageSize;
                $limits[1] = $pageSize;
            }
            $this->params['limit'] = implode(',', $limits);
        }
        $data = $client->getJSON($this->resource, $this->params);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function getRowsFromPageData(array $data)
    {
        if (isset($data[$this->resource]) && is_array($data[$this->resource])) {
            return array_values($data[$this->resource]);
        } else {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getTotalCountFromPageData(array $data, $previousValue)
    {
        if (isset($data[$this->resource])) {
            return count($data[$this->resource]);
        } else {
            return $previousValue;
        }
    }
}
