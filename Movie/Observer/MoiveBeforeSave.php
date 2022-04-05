<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class MoiveBeforeSave implements ObserverInterface
{
/**
* @param \Magento\Framework\Event\Observer $observer
* @return void
*/
public function execute(\Magento\Framework\Event\Observer $observer)
{
$customer = $observer->getData('movieData');
$customer->setData('rating', 0);
}

}
