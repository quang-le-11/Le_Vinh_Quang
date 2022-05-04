<?php

namespace Magenest\Movie\Controller\Adminhtml\File;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magenest\Movie\Model\ImageUploader;

class Upload extends Action
{
    /**
     * @param Action\Context $context
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Action\Context $context,
        ImageUploader  $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
//        $imageId = $this->_request->getParam('param_name', 'image');
        $imageId = 'image';
        $_FILES["image"] = [
            'name' => $_FILES['product']['name']['calendar_fieldset']['options'][0]['image_upload'],
            'type' => $_FILES['product']['type']['calendar_fieldset']['options'][0]['image_upload'],
            'tmp_name' => $_FILES['product']['tmp_name']['calendar_fieldset']['options'][0]['image_upload'],
            'error' => $_FILES['product']['error']['calendar_fieldset']['options'][0]['image_upload'],
            'size' => $_FILES['product']['size']['calendar_fieldset']['options'][0]['image_upload'],
        ];
        try {
            $result = $this->imageUploader->saveFileToTmpDir($imageId);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
