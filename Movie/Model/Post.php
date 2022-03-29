<?php

namespace Magenest\Movie\Model;

use  \Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    public function _construct()
    {
        $this->_init(\Magenest\Movie\Model\ResourceModel\post::class);
    }
}
