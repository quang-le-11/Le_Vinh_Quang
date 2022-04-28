<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class CustomerGroup extends Select
{

    protected  $customerGroup;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        array $data = []
    )
    {
        $this->customerGroup = $customerGroup;
        parent::__construct($context, $data);
    }

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


    /**
     * @return array
     */
    private function getSourceOptions()
    {
        $custome = $this->customerGroup->toOptionArray();
        $range = [];

        foreach ($custome as $item) {
            $range[] = ['label'=> $item['label'], 'value' =>$item['value']];
        }

//        for ($i = 1;$i<=5;$i++) {
//            $rangeText = "Range ".$i;
//            $range[] = ['label' => $rangeText, 'value' => $i];
//        }
        return $range;
    }
}
