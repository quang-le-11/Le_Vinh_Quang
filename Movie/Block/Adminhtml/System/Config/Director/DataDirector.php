<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config\Director;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class DataDirector extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactoty;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        array             $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $data);

    }

    /**
     * @return array|int|mixed|null
     */
    public function getDataDirector(){
        $actorCollection = $this->_collectionFactory->create();
        $actorCollection->getTable('magenest_director');
        return $actorCollection->getSize();
    }

}
