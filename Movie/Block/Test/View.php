<?php

namespace Magenest\Movie\Block\Test;

use Magento\Framework\View\Element\Template;

class View extends Template
{
    public function __construct(
        Template\Context $context,
        array            $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getTitle()
    {
        return __('HelloWorld!');
    }
}
