<?php

namespace Magenest\Movie\Model\ResourceModel\Calendar;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Calendar', 'Magenest\Movie\Model\ResourceModel\Calendar');
    }
}
