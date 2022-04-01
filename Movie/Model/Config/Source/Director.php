<?php

namespace Magenest\Movie\Model\Config\Source;

use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;


class Director implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $data = $this->getDataDirector();

        $result[0] = [
            'value' => null,
            'label' => __('--Please Select--')
        ];
        foreach ($data as $item) {
            $result[] = [
                'value' => $item['director_id'],
                'label' => $item['name']
            ];
        }
        return $result;
    }

    /**
     * @return array|null
     */
    public function getDataDirector()
    {
        $movieCollection = $this->_collectionFactory->create();
        return $movieCollection->getData();
    }
}
