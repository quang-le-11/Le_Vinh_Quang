<?php

namespace Magenest\Notification\Controller\Adminhtml\Notification;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class NewNotification extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory    $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultFactory = $this->pageFactory->create();
        $resultFactory->getConfig()->getTitle()->prepend(__('Magenest Notification'));
        return $resultFactory;
    }
}
