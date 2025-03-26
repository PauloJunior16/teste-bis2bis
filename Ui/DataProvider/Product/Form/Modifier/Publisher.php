<?php

namespace Bis2Bis\BookPublishers\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class Publisher extends AbstractModifier
{
    public function modifyMeta(array $meta)
    {
        $meta['publisher'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Publisher'),
                        'component' => 'Magento_Ui/js/form/element/select',
                        'dataScope' => 'publisher',
                        'formElement' => 'select',
                        'required' => false,
                        'options' => $this->getPublisherOptions(),
                        'visible' => true,
                        'validation' => [],
                        'sortOrder' => 100,
                    ],
                ],
            ],
        ];

        return $meta;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    private function getPublisherOptions()
    {
        $collection = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Bis2Bis\BookPublishers\Model\ResourceModel\Publisher\CollectionFactory::class)
            ->create()
            ->addFieldToFilter('status', ['eq' => 1]);

        $options = [];
        foreach ($collection as $publisher) {
            $options[] = ['value' => $publisher->getId(), 'label' => $publisher->getName()];
        }

        return $options;
    }
}
