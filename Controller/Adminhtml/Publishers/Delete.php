<?php
namespace Bis2Bis\BookPublishers\Controller\Adminhtml\Publishers;

use Magento\Backend\App\Action;
use Bis2Bis\BookPublishers\Model\PublisherFactory;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher as PublisherResource;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Bis2Bis_BookPublishers::publishers';

    protected $publisherFactory;
    protected $resource;

    public function __construct(
        Action\Context $context,
        PublisherFactory $publisherFactory,
        PublisherResource $resource
    ) {
        parent::__construct($context);
        $this->publisherFactory = $publisherFactory;
        $this->resource = $resource;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        try {
            $model = $this->publisherFactory->create();
            $this->resource->load($model, $id);
            
            if ($model->getId()) {
                $this->resource->delete($model);
                $this->messageManager->addSuccessMessage(__('Publisher deleted successfully'));
            } else {
                $this->messageManager->addErrorMessage(__('Publisher not found'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }
}
