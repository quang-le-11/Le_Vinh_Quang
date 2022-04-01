<?php

namespace Magenest\Movie\Model\ResourceModel\Director;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'director_id';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Director', 'Magenest\Movie\Model\ResourceModel\Director');
    }
}
