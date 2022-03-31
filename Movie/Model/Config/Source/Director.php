<?php

namespace Magenest\Movie\Model\Config\Source;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class Director implements \Magento\Framework\Option\ArrayInterface
{
    protected $_collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $data = $this->getDataDirector();

        $result = [
            'value' => null,
            'label' => __('--Please Select--')
        ];
        foreach ($data as $item) {
            $result[] = [
                'value' => $item['director_id'],
                'label' => $item['name']
            ];
        }

        return [$result];
    }

    public function getDataDirector(){
        $directorCollection = $this->_collectionFactory->create();
        $directorCollection->getTable('magenest_director');

        return $directorCollection->getData();

    }
}
