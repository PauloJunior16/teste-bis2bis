<?php

namespace Bis2Bis\BookPublishers\Model;

use Magento\Framework\Model\AbstractModel;

class Publisher extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Bis2Bis\BookPublishers\Model\ResourceModel\Publisher::class);
    }
}
