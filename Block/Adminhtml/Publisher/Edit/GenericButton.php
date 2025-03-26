<?php

namespace Bis2Bis\BookPublishers\Block\Adminhtml\Publisher\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class GenericButton
{
    protected $urlBuilder;
    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getId()
    {
        $publisher = $this->registry->registry('current_publisher');
        return $publisher ? $publisher->getId() : null;
    }
}
