<?php
namespace Bis2Bis\BookPublishers\Controller\Adminhtml\Publishers;

use Magento\Backend\App\Action;

class NewAction extends Action
{
    public const ADMIN_RESOURCE = 'Bis2Bis_BookPublishers::publishers';

    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Publisher'));
        return $resultPage;
    }
}
