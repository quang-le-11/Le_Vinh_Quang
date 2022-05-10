<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class BeforeSaveAddress implements ObserverInterface
{
    protected $checkoutSession;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    public function getQuotes()
    {
        return $this->checkoutSession->getQuote();
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();

        $ad = $this->getQuotes()->getShippingAddress()->getData('vn_region');
        $shipping_address = $order->getShippingAddress();
        $shipping_address->setData('vn_region', $ad);
    }
}
