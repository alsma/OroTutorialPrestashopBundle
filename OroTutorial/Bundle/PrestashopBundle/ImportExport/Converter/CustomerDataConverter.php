<?php

namespace OroTutorial\Bundle\PrestashopBundle\ImportExport\Converter;

use Oro\Bundle\ImportExportBundle\Converter\AbstractTableDataConverter;

class CustomerDataConverter extends AbstractTableDataConverter
{
    /**
     * {@inheritdoc}
     */
    protected function getHeaderConversionRules()
    {
        return [
            'id'        => 'remoteId',
            'email'     => 'email',
            'firstname' => 'firstName',
            'lastname'  => 'lastName',
            'birthday'  => 'birthday',
            'date_add'  => 'createdAt',
            'date_upd'  => 'updatedAt',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getBackendHeader()
    {
        // will be implemented for bidirectional sync
        throw new \Exception('Normalization is not implemented!');
    }
}
