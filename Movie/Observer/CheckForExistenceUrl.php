<?php

namespace Magenest\Movie\Observer;

use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class CheckForExistenceUrl implements \Magento\Framework\Event\ObserverInterface
{
    protected $collection;
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collection = $collectionFactory->create();
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Get the model object from observer
        $model = $observer->getEvent()->getDataObject();
        if (isset($model['id'])) {
            $url = $this->collection
                ->addFieldToFilter('url_rewrite', ['eq' => $model['url_rewrite']])
                ->addFieldToFilter('id', ['neq' => $model['id']]);
        } else {
            $url = $this->collection->addFieldToFilter('url_rewrite', ['eq' => $model['url_rewrite']]);
            if ($url->getSize() != 0) {
                throw new LocalizedException(__('Url đã tồn tại.'));
            }
        }
    }
}
