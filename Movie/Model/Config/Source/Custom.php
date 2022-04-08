<?php

namespace Magenest\Movie\Model\Config\Source;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => '1',
                'label' => 'show',
            ], [
                'value' => '2',
                'label' => 'not-show',
            ]
        ];
    }
}
