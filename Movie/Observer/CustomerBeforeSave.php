<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerBeforeSave implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getCustomer();
        $customer->setData('firstname', 'Magenest');
    }

}
