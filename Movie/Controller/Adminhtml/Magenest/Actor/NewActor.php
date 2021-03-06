<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Actor;


use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

/**
 * Class AddNew
 * @package ViMagento\HelloWorld\Controller\Adminhtml\Post
 */
class NewActor extends Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Magenest Movie'));
        return $resultPage;
    }
}
