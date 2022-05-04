<?php

namespace Magenest\Movie\Controller\Adminhtml\Customer;

class Avatar extends \Magento\Customer\Controller\Adminhtml\Index
{
    public function execute()
    {

        $this->initCurrentCustomer();
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}
