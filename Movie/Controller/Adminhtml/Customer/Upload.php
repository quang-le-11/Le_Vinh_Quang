<?php

namespace Magenest\Movie\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Backend\App\Action
{
    /**]
     * @var \Magenest\Movie\Model\ImageUploader
     */
    protected $imageUploader;

    /**
     * @param Context $context
     * @param \Magenest\Movie\Model\ImageUploader $imageUploader
     */
    public function __construct(
        Context $context,
        \Magenest\Movie\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'image');

        try {
            $result = $this->imageUploader->saveFileToTmpDir($imageId);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
