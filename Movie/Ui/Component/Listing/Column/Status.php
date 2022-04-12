<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;

class Status extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;
    protected $escaper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderRepositoryInterface $orderRepository
     * @param SearchCriteriaBuilder $criteria
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface         $context,
        UiComponentFactory       $uiComponentFactory,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder    $criteria,
        Escaper                  $escaper,
        array                    $components = [],
        array                    $data = []
    ) {
        $this->escaper = $escaper;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $order = $this->_orderRepository->get($item["entity_id"]);
                $number = (int)($order->getData('increment_id'));
                if ($number % 2 == 0) {
                    $export_status = '<span class="grid-severity-major">Odd</span>';
                } else {
                    $export_status = '<span class="grid-severity-notice">Even</span>';
                }

                // $this->getData('name') returns the name of the column so in this case it would return export_status
                $item[$this->getData('name')] = $this->escaper->escapeHtml($export_status, ['span']);
            }
        }
        return $dataSource;
    }
}
