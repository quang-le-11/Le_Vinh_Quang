<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Customer extends AbstractFieldArray
{
    protected $customerGroup;
    protected $startDay;
    protected $endday;


    protected function _prepareToRender()
    {
        $this->addColumn('customer_group', [
            'label' => __('Customer Group'),
            'renderer' => $this->getCustomerGroup()
        ]);
        $this->addColumn(
            'start_date',
            [
                'label' => __('From'),
                'id' => 'select_date',
                'class' => 'daterecuring',
                'style' => 'width:110px'
            ]
        );

        $this->addColumn(
            'end_date',
            [
                'label' => __('To'),
                'id' => 'select_date',
                'class' => 'daterecuring',
                'style' => 'width:110px'
            ]
        );
    /**
     * @var
     */
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Minimum Qty');
    }

    private function getCustomerGroup()
    {
        if(!$this->customerGroup){
            $this->customerGroup = $this->getLayout()->createBlock(
                CustomerGroup::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->customerGroup->setClass('custom_end_range required-entry');
            $this->customerGroup->setExtraParams('style="width:110px"');
        }
        return $this->customerGroup;
    }

//    private  function  getStartDay()
//    {
//
//        if(!$this->startDay){
//            $this->startDay = $this->getLayout()->createBlock(
//                StartDay::class,
//                '',
//                ['data' => ['is_render_to_js_template' => true]]
//            );
//            $this->startDay->setClass('start_day_column required-entry');
//            $this->startDay->setExtraParams('style="width:110px"');
//        }
//        return $this->startDay;
//    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = parent::_getElementHtml($element);

        $script = '<script type="text/javascript">
                require(["jquery", "jquery/ui", "mage/calendar"], function (jq) {
                    jq(function(){
                        function bindDatePicker() {
                            setTimeout(function() {
                                jq(".daterecuring").datepicker( { dateFormat: "mm/dd/yy" } );
                            }, 50);
                        }
                        bindDatePicker();
                        jq("button.action-add").on("click", function(e) {
                            bindDatePicker();
                        });
                    });
                });
            </script>';
        $html .= $script;
        return $html;
    }
}
