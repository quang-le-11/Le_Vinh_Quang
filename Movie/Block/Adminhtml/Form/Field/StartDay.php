<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class StartDay extends Select
{
    public function setInputName($value)
    {
        return $this->setName($value);
    }


    public function setInputId($value)
    {
        return $this->setId($value);
    }


    /**
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }
    private function getSourceOptions()
    {
        return [
            ['label' => 'Yes','value' => '1'],
            ['label' => 'No','value' => '0'],
        ];
    }
}
