<?php

namespace Bis2Bis\BookPublishers\Controller\Adminhtml\Publishers;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Edit extends Action
{
    public const ADMIN_RESOURCE = 'Bis2Bis_BookPublishers::publishers';

    protected $resultPageFactory;
    protected $registry;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Bis2Bis\BookPublishers\Model\Publisher::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This publisher no longer exists'));
                return $this->_redirect('*/*/index');
            }
        }

        $this->registry->register('current_publisher', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bis2Bis_BookPublishers::publishers');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Publisher'));

        return $resultPage;
    }
}
