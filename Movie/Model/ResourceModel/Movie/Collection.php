<?php

namespace Magenest\Movie\Model\ResourceModel\Movie;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Movie', 'Magenest\Movie\Model\ResourceModel\Movie');
    }
}
