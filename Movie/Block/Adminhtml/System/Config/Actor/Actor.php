<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config\Actor;

use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory;

class Actor extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_collectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        CollectionFactory                       $collectionFactory,
        array                                   $data = []
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(
        \Magento\Framework\Data\Form\Element\AbstractElement $element
    ) {
        $value = $this->getCountActor();
        $html = '<input id="salesforce_general_magenest_movie" name="groups[general][fields][magenest_movie][value]" data-ui-id="adminhtml-system-config-movie-movie-0-text-groups-general-fields-magenest-movie-value" value="' . $value . '" class=" input-text admin__control-text" type="text" readonly>';
        return $html;
    }

    /**
     * @return int
     */
    public function getCountActor()
    {
        $actorCollection = $this->_collectionFactory->create();
        return $actorCollection->getSize();
    }
}
