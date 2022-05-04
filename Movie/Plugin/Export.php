<?php

namespace Magenest\Movie\Plugin;


use Magento\Framework\Message\ManagerInterface as MessageManager;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as SalesOrderGridCollection;

class Export
{
    protected $messageManager;
    protected $collection;

    /**
     * @param MessageManager $messageManager
     * @param SalesOrderGridCollection $collection
     */
    public function __construct(
        MessageManager           $messageManager,
        SalesOrderGridCollection $collection
    )
    {

        $this->messageManager = $messageManager;
        $this->collection = $collection;
    }

    /**
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject
     * @param \Closure $proceed
     * @param $requestName
     * @return SalesOrderGridCollection
     */
    public function aroundGetReport(
        \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject,
        \Closure                                                                   $proceed,
                                                                                   $requestName
    )
    {
        $result = $proceed($requestName);
        if ($requestName == 'sales_order_grid_data_source') {
            if ($result instanceof $this->collection
            ) {
                $select = $this->collection->getSelect();
                $select->join(
                    ["sst" => "sales_shipment_track"],
                    'main_table.entity_id = sst.entity_id',
                    'sst.track_number'
                )
                    ->distinct();
            }

        }
        return $this->collection;
    }
}
