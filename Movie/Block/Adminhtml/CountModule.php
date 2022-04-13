<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Module\FullModuleList;
use Magento\Customer\Model\CustomerFactory;


class CountModule extends Template
{
    protected $fullModuleList;
    protected $customerFactory;
    protected $productFactory;
    protected $orderCollectionFactory;
    protected $invoice_collection;
    protected $searchCriteria;
    protected $creditmemoCollection;

    /**
     * @param FullModuleList $fullModuleList
     * @param CustomerFactory $customerFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @param \Magento\Sales\Model\Order\InvoiceRepositoryFactory $invoiceRepositoryFactory
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @param \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Collection $creditmemoCollection
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct (
        FullModuleList                                                 $fullModuleList,
        CustomerFactory                                                $customerFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory     $orderCollectionFactory,
        \Magento\Sales\Model\Order\InvoiceRepositoryFactory            $invoiceRepositoryFactory,
        \Magento\Framework\Api\SearchCriteriaInterface                 $searchCriteria,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Collection $creditmemoCollection,
        Template\Context                                               $context,
        array                                                          $data = []
    ) {
        $this->customerFactory = $customerFactory;
        $this->fullModuleList = $fullModuleList;
        $this->productFactory = $productFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->invoice_collection = $invoiceRepositoryFactory;
        $this->searchCriteria = $searchCriteria;
        $this->creditmemoCollection = $creditmemoCollection;

        parent::__construct($context, $data);
    }

    public function countModuleMagento()
    {
        $allModules = $this->fullModuleList->getAll();
        $count = 0;
        foreach ($allModules as $itme) {
            $str = $itme['name'];
            $sub = 'Magento';
            if (strpos($str, $sub) !== false) {
                $count++;
            }
        }
        return $count;
    }

    public function countNoModuleMagento()
    {
        $allModules = $this->fullModuleList->getAll();
        $count = 0;
        foreach ($allModules as $itme) {
            $str = $itme['name'];
            $sub = 'Magento';
            if (strpos($str, $sub) === false) {
                $count++;
            }
        }
        return $count;
    }

    public function getSizeCustomer()
    {
        $collection = $this->customerFactory->create()->getCollection();
        $size = $collection->getSize();
        return $size;
    }

    public function getSizeProduct()
    {
        $productCollection = $this->productFactory->create();
        return $productCollection->getSize();
    }

    public function getSizeOrder()
    {
        $ordercollection = $this->orderCollectionFactory->create();
        return $ordercollection->getSize();
    }

    public function getSizeInvoice()
    {
        $this->searchCriteria->setFilterGroups();
        $invoiceRepo = $this->invoice_collection->create();
        $invoiceRepoCollection = $invoiceRepo->getList($this->searchCriteria);
        return $invoiceRepoCollection->getSize();
    }

    public function getSizeCreditmemo()
    {
        $collection = $this->creditmemoCollection;
        return $collection->getSize();
    }
}
