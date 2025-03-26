<?php

namespace Bis2Bis\BookPublishers\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher\CollectionFactory;

class PublisherOptions extends AbstractSource
{
    private $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get all options for the dropdown.
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [];
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter('status', ['eq' => 1]);

            foreach ($collection as $publisher) {
                $this->_options[] = [
                    'value' => $publisher->getId(),
                    'label' => $publisher->getName(),
                ];
            }
        }

        return $this->_options;
    }
}