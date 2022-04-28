<?php

namespace Magenest\Movie\Model;

use  \Magento\Framework\Model\AbstractModel;

class Calendar extends AbstractModel
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Calendar');
    }
}
