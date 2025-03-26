<?php

namespace Bis2Bis\BookPublishers\Model\ResourceModel\Publisher;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Bis2Bis\BookPublishers\Model\Publisher as PublisherModel;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher as PublisherResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(PublisherModel::class, PublisherResource::class);
    }
}
