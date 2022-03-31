<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Button extends Field
{
    protected $_template = 'Magenest_Movie::system/config/button.phtml';

    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getReloadUrl()
    {
        return $this->getUrl('adminhtml/system_config/edit/section/salesforce/');
    }

    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setData([
                    'id' => 'btn_id',
                    'label' => __('Button Label'),
                    'onclick' => "setLocation('" . $this->getReloadUrl() . "')"]
            );
        return $button->toHtml();
    }
}
