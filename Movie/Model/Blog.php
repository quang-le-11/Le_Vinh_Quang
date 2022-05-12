<?php

namespace Magenest\Movie\Model;

use  \Magento\Framework\Model\AbstractModel;

class Blog extends AbstractModel
{
    protected $_eventPrefix = 'blog';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Blog');
    }
}
