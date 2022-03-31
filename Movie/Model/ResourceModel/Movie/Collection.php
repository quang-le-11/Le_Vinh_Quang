<?php

namespace Magenest\Movie\Model\ResourceModel\Movie;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'movie_id';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Movie', 'Magenest\Movie\Model\ResourceModel\Movie');
    }
}
