<?php

namespace Bis2Bis\BookPublishers\Ui\Component;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    
    public function getData()
    {
        if (!$this->collection->isLoaded()) {
            $this->collection->load();
        }
    
        $items = $this->collection->toArray();
    
        return [
            'totalRecords' => $items['totalRecords'],
            'items' => $items['items'],
        ];
    }

}
