<?php

namespace Magenest\Movie\Block\Blog;

use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Blog extends \Magento\Framework\View\Element\Template
{
    protected $collection;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    )  {
        $this->collection = $collectionFactory->create();
        parent::__construct($context, $data);
    }

    public function getBlog()
    {
        $id = $this->getRequest()->getParam('id');
        if($id){
            return $this->collection->addFieldToFilter('id', ['eq' => $id]);
        }
        return $this->collection;
    }
}
