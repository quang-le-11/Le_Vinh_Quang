<?php

namespace Magenest\Movie\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magenest_blog', 'id');
    }
}
