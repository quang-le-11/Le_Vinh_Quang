<?php

namespace Magenest\Movie\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('magenest_movie', 'movie_id');
    }
}
