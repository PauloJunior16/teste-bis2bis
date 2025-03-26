<?php

namespace Bis2Bis\BookPublishers\Controller\Adminhtml\Publishers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Bis2Bis\BookPublishers\Model\PublisherFactory;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher as PublisherResource;
use Psr\Log\LoggerInterface;

class Save extends Action
{
    public const ADMIN_RESOURCE = 'Bis2Bis_BookPublishers::publishers';

    protected $publisherFactory;
    protected $resource;
    protected $_logger;

    public function __construct(
        Context $context,
        PublisherFactory $publisherFactory,
        PublisherResource $resource,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->publisherFactory = $publisherFactory;
        $this->resource = $resource;
        $this->_logger = $logger;
    }

    public function execute()
    {
        try {
            $data = $this->getRequest()->getPostValue();
            if (isset($data['logo'][0]['file'])) {
                $data['logo'] = $data['logo'][0]['file'];
            } else {
                unset($data['logo']);
            }

            $id = isset($data['id']) ? (int) $data['id'] : null;
            $model = $this->_objectManager->create(\Bis2Bis\BookPublishers\Model\Publisher::class);

            if ($id) {
                $model->load($id);
            }

            $model->setData($data);
            $model->save();

            $this->messageManager->addSuccessMessage(__('Publisher saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error saving publisher: ') . $e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }
}
