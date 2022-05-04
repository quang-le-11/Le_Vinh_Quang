<?php

namespace Magenest\Movie\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\Form\Fieldset;

class Calendar extends AbstractModifier
{
    protected $arrayManager;

    /**
     * @param ArrayManager $arrayManager
     */
    public function __construct(
        ArrayManager $arrayManager
    ) {
        $this->arrayManager = $arrayManager;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $meta = $this->enableTime($meta);
        return $meta;
    }

    /**
     * @param array $data
     * @return array
     */
    public function modifyData(array $data)
    {

        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    protected function enableTime(array $meta)
    {
        $meta['field_ calendar'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Customizable Calendar'),
                        'componentType' => Fieldset::NAME,
                        'sortOrder' => 20,
                        'collapsible' => true
                    ]
                ]
            ],
            'children' => [
                'field_ calendar' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Calendar'),
                                'formElement' => 'date',
                                'componentType' => 'field',
                                'component' => 'Magenest_Movie/js/calendar',
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return $meta;
    }
}
