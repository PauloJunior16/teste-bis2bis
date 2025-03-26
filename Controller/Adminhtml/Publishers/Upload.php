<?php

namespace Bis2Bis\BookPublishers\Controller\Adminhtml\Publishers;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class Upload extends Action
{
    public const ADMIN_RESOURCE = 'Bis2Bis_BookPublishers::publishers';

    protected $jsonFactory;
    protected $filesystem;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        try {
            $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'logo']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $target = $mediaDirectory->getAbsolutePath('bookpublishers/logos/');

            $result = $uploader->save($target);

            return $this->jsonFactory->create()->setData([
                'file' => 'bookpublishers/logos/' . $result['file'],
                'name' => $result['file'],
                'type' => $result['type'],
                'size' => $result['size']
            ]);
        } catch (\Exception $e) {
            return $this->jsonFactory->create()->setData(['error' => true, 'message' => __('Error uploading image: ') . $e->getMessage()]);
        }
    }
}
