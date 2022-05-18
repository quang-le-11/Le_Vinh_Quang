<?php

namespace Magenest\Movie\Controller\Test;

use Magento\Framework\App\Action\Context;

class View extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;

    public function __construct(
        Context                                    $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
