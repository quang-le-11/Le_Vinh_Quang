<?php

namespace Magenest\Notification\Model\Config\Source;

use Magenest\Notification\Model\ResourceModel\Promo\CollectionFactory;

class PromoOptionsStatus implements \Magento\Framework\Option\ArrayInterface
{
    protected $collectionFactory;
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $data = $this->getDataFromo();

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

    public function getDataFromo()
    {
        $movieCollection = $this->collectionFactory->create();
        return $movieCollection->getData();
    }
}
