<?php

namespace Bis2Bis\BookPublishers\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class PublisherActions extends Column
{
    protected $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')] = [
                        [
                            'href' => $this->urlBuilder->getUrl(
                                'bookpublishers/publishers/edit',
                                ['id' => $item['id']]
                            ),
                            'label' => __('Edit'),
                            'hidden' => false
                        ],
                        [
                            'href' => $this->urlBuilder->getUrl(
                                'bookpublishers/publishers/delete',
                                ['id' => $item['id']]
                            ),
                            'label' => __('Delete'),
                            'hidden' => false,
                            'confirm' => [
                                'title' => __('Delete %1', $item['name'] ?? ''),
                                'message' => __('Are you sure you want to delete "%1"?', $item['name'] ?? '')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
