<?php

namespace Bis2Bis\BookPublishers\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public const XML_PATH_ENABLE_FEATURE = 'bookpublishers/general/enable_feature';

    /**
     * Check if the Book Publishers feature is enabled
     *
     * @return bool
     */
    public function isFeatureEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLE_FEATURE, ScopeInterface::SCOPE_STORE);
    }
}
