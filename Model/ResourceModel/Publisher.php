<?php

namespace Bis2Bis\BookPublishers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Publisher extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('publisher_table', 'id');
    }
}
