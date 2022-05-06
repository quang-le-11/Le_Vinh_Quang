<?php

namespace Magenest\Movie\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Region extends AbstractSource
{
    public function getAllOptions()
    {
        if ($this->_options == null) {
            $this->_options = [
                ['label' =>__('Miền bắc') , 'value' => 1 ],
                ['label' =>__('Miền trung') , 'value' => 2 ],
                ['label' =>__('Miền nam') , 'value' => 3 ]
            ];
        }
        return $this->_options;
    }
}
