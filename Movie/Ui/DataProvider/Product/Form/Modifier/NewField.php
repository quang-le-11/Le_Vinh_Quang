<?php

namespace Magenest\Movie\Ui\DataProvider\Product\Form\Modifier;

use Magenest\Movie\Model\ResourceModel\Calendar\CollectionFactory;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Downloadable\Model\Product\Type;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Hidden;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;

class NewField extends AbstractModifier
{
    const FIELD_ENABLE = 'affect_product_custom_options';
    const CONTAINER_HEADER_NAME = 'container_header';
    const GROUP_CUSTOMIZE_CALENDAR_OPTIONS_NAME = 'field_calendar';
    const GRID_OPTIONS_NAME = 'options';
    const FIELD_IS_DELETE = 'is_delete';
    const CONTAINER_OPTION = 'container_option';
    const FIELD_SORT_ORDER_NAME = 'sort_order';
    const FIELD_TITLE_NAME = 'title';
    const FIELD_OPTION_ID = 'option_id';
    const  CUSTOM_OPTIONS_LISTING = 'product_custom_option';
    const BUTTON_ADD = 'button_add';
    const CONTAINER_COMMON_NAME = 'container_common';

    protected $locator;
    protected $collection;
    protected $storeManager;

    /**
     * @param LocatorInterface $locator
     * @param CollectionFactory $collection
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        LocatorInterface      $locator,
        CollectionFactory     $collection,
        StoreManagerInterface $storeManager
    ) {
        $this->locator = $locator;
        $this->collection = $collection;
        $this->storeManager = $storeManager;
    }

    /**
     * @param array $data
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function modifyData(array $data)
    {
        $model = $this->locator->getProduct();

        $idProduct = $model->getId();

        $calendarCollection = $this->collection->create()->getItems();
        $url = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $avatar = [];
        $dataOptions = [];

        foreach ($calendarCollection as $item) {
            if ($idProduct === $item['product_id']) {
                if (isset($item['uploadCalendar'])) {
                    $imageData = json_decode($item['uploadCalendar'], true);
                    $avatar = [
                        [
                            'name' => $imageData[0]['name'],
                            'url' => $url . $imageData[0]['url'],
                            'previewType' => $imageData[0]['previewType'],
                            'id' => $imageData[0]['id'],
                            'size' => $imageData[0]['size']
                        ]
                    ];
                }
                $dataOptions[] = [
                    'record_id' => '0',
                    'sort_order' => '',
                    'option_id' => '',
                    'title' => $item['calendar'],
                    'image_upload' => $avatar
                ];
            }
        }
        $data[$idProduct]['product']['calendar_fieldset'] = [
            'options' => $dataOptions
        ];
        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $meta = $this->createCustomizeCalendarOptionsPanel($meta);
        return $meta;
    }

    /**
     * @param $mate
     * @return array
     */
    public function createCustomizeCalendarOptionsPanel($mate)
    {
        $mate = array_replace_recursive(
            $mate,
            [
                static::GROUP_CUSTOMIZE_CALENDAR_OPTIONS_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Customize Calendar'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.calendar_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
                        static::CONTAINER_HEADER_NAME => $this->getHeaderContainerConfig(10),
                        static::FIELD_ENABLE => $this->getEnableFieldConfig(20),
                        static::GRID_OPTIONS_NAME => $this->getOptionsGridConfig(30)
                    ]
                ]
            ]
        );
        return $mate;
    }

    /**
     * @param $sortOrder
     * @return array
     */
    public function getHeaderContainerConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => null,
                        'formElement' => Container::NAME,
                        'componentType' => Container::NAME,
                        'template' => 'ui/form/components/complex',
                        'sortOrder' => $sortOrder,
                        'content' => __('Custom options let customers choose the product variations they want.'),
                    ],
                ],
            ],
            'children' => [
                static::BUTTON_ADD => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'title' => __('Add Option'),
                                'formElement' => Container::NAME,
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/form/components/button',
                                'sortOrder' => 20,
                                'actions' => [
                                    [
                                        'targetName' => '${ $.ns }.${ $.ns }.' . static::GROUP_CUSTOMIZE_CALENDAR_OPTIONS_NAME
                                            . '.' . static::GRID_OPTIONS_NAME,
                                        '__disableTmpl' => ['targetName' => false],
                                        'actionName' => 'processingAddChild',
                                    ]
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $sortOrder
     * @return \array[][][]
     */
    protected function getEnableFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'formElement' => Field::NAME,
                        'componentType' => Input::NAME,
                        'dataScope' => static::FIELD_ENABLE,
                        'dataType' => 'number',
                        'visible' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $sortOrder
     * @return array
     */
    protected function getOptionsGridConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Add Option'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Catalog/js/components/dynamic-rows-import-custom-options',
                        'template' => 'ui/dynamic-rows/templates/collapsible',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => static::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'addButton' => false,
                        'renderDefaultRecord' => false,
                        'columnsHeader' => false,
                        'collapsibleHeader' => true,
                        'sortOrder' => $sortOrder,
                        'dataProvider' => static::CUSTOM_OPTIONS_LISTING,
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'headerLabel' => __('New Option'),
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        static::CONTAINER_OPTION => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => Fieldset::NAME,
                                        'collapsible' => true,
                                        'label' => null,
                                        'sortOrder' => 10,
                                        'opened' => true,
                                    ],
                                ],
                            ],
                            'children' => [
                                static::FIELD_SORT_ORDER_NAME => $this->getPositionFieldConfig(40),
                                static::CONTAINER_COMMON_NAME => $this->getCommonContainerConfig(10)
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }

    /**
     * @param $sortOrder
     * @return \array[][][]
     */
    protected function getPositionFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => Field::NAME,
                        'formElement' => Hidden::NAME,
                        'dataScope' => static::FIELD_SORT_ORDER_NAME,
                        'dataType' => Number::NAME,
                        'visible' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $sortOrder
     * @return array
     */
    protected function getCommonContainerConfig($sortOrder)
    {
        $commonContainer = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Options Select'),
                        'componentType' => Container::NAME,
                        'formElement' => Container::NAME,
                        'component' => 'Magento_Ui/js/form/components/group',
                        'breakLine' => false,
                        'showLabel' => false,
                        'additionalClasses' => 'admin__field-group-columns admin__control-group-equal',
                        'sortOrder' => $sortOrder,
                    ],
                ],

            ],
            'children' => [
                static::FIELD_OPTION_ID => $this->getOptionIdFieldConfig(10),
                static::FIELD_TITLE_NAME => $this->getTitleFieldConfig(
                    20,
                    [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'label' => __('Calendar'),
//                                    'component' => 'Magento_Catalog/component/static-type-input',
                                    'valueUpdate' => 'input'
                                ],
                            ],
                        ],
                    ]
                ),
                'test_avc' => $this->getUploadCanlendar(30),
            ]
        ];
        return $commonContainer;
    }

    /**
     * @param $sortOrder
     * @return \array[][][]
     */
    protected function getOptionIdFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'formElement' => Input::NAME,
                        'componentType' => Field::NAME,
                        'dataScope' => static::FIELD_OPTION_ID,
                        'sortOrder' => $sortOrder,
                        'visible' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $sortOrder
     * @param array $options
     * @return array
     */
    protected function getTitleFieldConfig($sortOrder, array $options = [])
    {
        return array_replace_recursive(
            [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label' => __('Calender'),
                            'componentType' => Field::NAME,
                            'formElement' => Input::NAME,
                            'dataScope' => static::FIELD_TITLE_NAME,
                            'dataType' => Text::NAME,
                            'sortOrder' => $sortOrder,
                            'validation' => [
                                'required-entry' => true
                            ],
                        ],
                    ],
                ],
            ],
            $options
        );
    }

    /**
     * @param $sortOrder
     * @return \array[][][]
     */
    protected function getUploadCanlendar($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => null,
                        'componentType' => Field::NAME,
                        'previewTmpl' => 'Magento_Catalog/image-preview',
                        'elementTmpl' => 'ui/form/element/uploader/uploader',
                        'formElement' => "fileUploader",
                        'dataScope' => "image_upload",
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'visible' => 1,
                        'uploaderConfig' => ['url' => 'movie/file/upload'],
                    ],
                ],
            ],
        ];
    }
}
