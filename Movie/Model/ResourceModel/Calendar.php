<?php

namespace Magenest\Movie\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Calendar extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('calendar', 'entity_id');
    }
}
