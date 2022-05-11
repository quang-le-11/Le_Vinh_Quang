<?php

namespace Magenest\Movie\Model\ResourceModel\Blog\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    protected $itemOrder;
    protected $addFilterStrategies;

    protected $_map = [
        'fields' => [
            'author' => 'author.username',
            'status' => 'main_table.status',
            'create_at' => 'main_table.create_at',
            'update_at' => 'main_table.update_at',
        ]
    ];

    public function __construct(
        EntityFactory $entityFactory,
        Logger        $logger,
        FetchStrategy $fetchStrategy,
        EventManager  $eventManager,
        array         $addFilterStrategies = [],
        $mainTable = 'magenest_blog',
        $resourceModel = 'Magenest\Movie\Model\ResourceModel\Blog',
        $identifierName = null,
        $connectionName = null
    ) {
        $this->addFilterStrategies = $addFilterStrategies;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()
            ->joinLeft(
                ['author' => $this->getTable('admin_user')],
                "main_table.author_id = author.user_id",
                ['author' => 'author.username']
            );
        return $this;
    }
}
