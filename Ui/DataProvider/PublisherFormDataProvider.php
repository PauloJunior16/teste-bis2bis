<?php

namespace Bis2Bis\BookPublishers\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher\CollectionFactory;
use Bis2Bis\BookPublishers\Model\PublisherFactory;
use Bis2Bis\BookPublishers\Model\ResourceModel\Publisher;
use Magento\Framework\App\RequestInterface;
use Bis2Bis\BookPublishers\Helper\Data as ModuleHelper;

class PublisherFormDataProvider extends AbstractDataProvider
{
    protected $collection;
    protected $publisherFactory;
    protected $resource;
    protected $loadedData;
    protected $request;
    protected $helper;

    public function __construct(
        ModuleHelper $helper,
        CollectionFactory $collectionFactory,
        PublisherFactory $publisherFactory,
        Publisher $resource,
        RequestInterface $request,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->helper = $helper;
        $this->collection = $collectionFactory->create();
        $this->publisherFactory = $publisherFactory;
        $this->resource = $resource;
        $this->request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (!$this->helper->isFeatureEnabled()) {
            return [];
        }

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $id = $this->request->getParam('id');
        $model = $this->publisherFactory->create();

        if ($id) {
            $this->resource->load($model, $id);
            $data = $model->getData();

            if (!empty($data['logo'])) {
                $data['logo'] = [
                    [
                        'name' => basename($data['logo']),
                        'url' => $this->_getMediaUrl() . ltrim($data['logo'], '/'),
                    ],
                ];
            }

            $this->loadedData[$model->getId()] = $data;
        }

        return $this->loadedData;
    }

    protected function _getMediaUrl()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Store\Model\StoreManagerInterface::class)
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
