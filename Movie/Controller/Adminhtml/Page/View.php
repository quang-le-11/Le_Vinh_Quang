<?php

namespace Magenest\Movie\Controller\Adminhtml\Page;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class View extends Action
{
    protected $pageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory    $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->prepend('Page');
        return $page;
    }
}
