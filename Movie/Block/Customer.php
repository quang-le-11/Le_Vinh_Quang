<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;

class Customer extends Template
{
    protected $resultPageFactory;
    protected $_customerSession;

    public function __construct(
        Template\Context                           $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session            $customerSession,
        array                                      $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }

    public function getCustomer()
    {
        return $this->_customerSession->getCustomer();
    }
}
