<?php

namespace Magenest\Notification\Model;

use Magento\Framework\Model\AbstractModel;
class Promo extends AbstractModel
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Magenest\Notification\Model\ResourceModel\Promo::class);
    }
}
