<?php

namespace Magenest\Movie\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    protected $eavConfig;

    public function __construct(
        Context $context,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->eavConfig = $eavConfig;
        parent::__construct($context);
    }

    public function getCustomerAddress()
    {
        $attribute = $this->eavConfig->getAttribute('customer_address', "vn_region");
        return $attribute->getSource()->getAllOptions();
    }
}
