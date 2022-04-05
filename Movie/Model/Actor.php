<?php

namespace Magenest\Movie\Model;

use  \Magento\Framework\Model\AbstractModel;

class Actor extends AbstractModel
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Actor');
    }
}
