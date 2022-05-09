<?php

namespace Magenest\Movie\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class RegionPlugin
{

    public function afterProcess(LayoutProcessor $subject, $jsLayout)
    {
        $customAttributeCode = 'vn_region';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'drop-down',
            ],
            'dataScope' => 'shippingAddress.custom_attributes.' . $customAttributeCode,
            'label' => 'Region Viet Nam',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => ['required-entry' => true],
            'sortOrder' => 150,
            'id' => 'drop-down',
            'options' => [
                [
                    'value' => 1,
                    'label' => 'Miền Bắc',
                ],
                [
                    'value' => 2,
                    'label' => 'Miền Trung',
                ],
                [
                    'value' => 3,
                    'label' => 'Miền Nam',
                ]
            ]
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        return $jsLayout;
    }

}
