<?php

namespace Magenest\Movie\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Post', 'Magenest\Movie\Model\ResourceModel\Post');
    }
}
