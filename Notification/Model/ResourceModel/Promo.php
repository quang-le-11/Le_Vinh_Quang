<?php

namespace Magenest\Notification\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Promo extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('promo_notification', 'entity_id');
    }
}
