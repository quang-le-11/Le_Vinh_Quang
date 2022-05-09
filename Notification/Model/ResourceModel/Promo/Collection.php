<?php

namespace Magenest\Notification\Model\ResourceModel\Promo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Magenest\Notification\Model\Promo::class, \Magenest\Notification\Model\ResourceModel\Promo::class);
    }
}
