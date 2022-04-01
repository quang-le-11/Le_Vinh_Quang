<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config\Director;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;

class DataDirector extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

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
     * @return int
     */
    public function getDataDirector()
    {
        $movieCollection = $this->_collectionFactory->create();
        return $movieCollection->getSize();
    }
}
