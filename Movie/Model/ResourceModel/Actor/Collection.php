<?php

namespace Magenest\Movie\Model\ResourceModel\Actor;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'actor_id';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Actor', 'Magenest\Movie\Model\ResourceModel\Actor');
    }
}
