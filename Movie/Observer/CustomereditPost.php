<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomereditPost implements ObserverInterface
{

    protected $customerRepository;
    protected $_request;
    protected $_layout;
    protected $_objectManager = null;
    protected $_customerGroup;
    private $logger;
    protected $_customerRepositoryInterface;

    /**
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        \Magento\Framework\View\Element\Context           $context,
        \Magento\Framework\ObjectManagerInterface         $objectManager,
        \Psr\Log\LoggerInterface                          $logger,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerRepositoryInterface                       $customerRepository
    ) {
        $this->_layout = $context->getLayout();
        $this->_request = $context->getRequest();
        $this->_objectManager = $objectManager;
        $this->logger = $logger;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        $this->logger->info(' --jafar123--  ');
        $event = $observer->getEvent();
        $customer = $observer->getData('customer');
        $customer->setFirstname('Magenest');
        $this->customerRepository->save($customer);
    }
}
