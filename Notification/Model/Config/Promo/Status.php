<?php

namespace Magenest\Notification\Model\Config\Promo;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('enable')],
            ['value' => 2, 'label' => __('disable')]
        ];
    }
}
