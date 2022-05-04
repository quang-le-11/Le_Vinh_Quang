<?php

namespace Magenest\Movie\Block\Adminhtml\Customer;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

class EditAvatar extends Template
{
    protected $urlBuilder;
    protected $customerSession;
    protected $storeManager;
    protected $customerModel;
    protected $customerFactory;

    public function __construct(
        Context $context,
        UrlInterface $urlBuilder,

        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerModel,
        array $data = []
    )
    {
        $this->urlBuilder            = $urlBuilder;
        $this->storeManager          = $storeManager;
        $this->customerModel         = $customerModel;
        parent::__construct($context, $data);
    }

    public function getBaseUrl()
    {
        return $this->storeManager->getStore();
    }

    public function getMediaUrl()
    {
        return $this->getBaseUrl() . 'media/';
    }

    public function getCustomerImageUrl($filePath)
    {
        return $this->getMediaUrl() . 'customer' . $filePath;
    }

    public function getFileUrl()
    {
        $getParamcustomer = $this->getRequest()->getParams();
        $id =$getParamcustomer['id'];

        $customerData = $this->customerModel->create()
            ->load($id);
         $url = $customerData->getData('customer_attribute_avatar');
//        if (!empty($url)) {
//            return $this->getCustomerImageUrl($url);
//        }
//        return false;

        return $url;
    }
}
