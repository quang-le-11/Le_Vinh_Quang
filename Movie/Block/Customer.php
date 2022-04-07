<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

class Customer extends Template
{
    protected $_customerSession;

    /**
     * @param Template\Context $context
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context                           $context,
        Session                                    $customerSession,
        array                                      $data = []
    ) {
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Customer\Model\Customer
     */
    public function getCustomer()
    {
        $customerData = $this->_customerSession->getCustomer();
        return $customerData;
    }
}
