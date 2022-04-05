<?php

namespace Magenest\Movie\Model\ResourceModel\Processing\Grid;


use Magento\Catalog\Model\Product;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;
use Magento\Sales\Model\ResourceModel\Order\Item;
use Magento\Eav\Model\ResourceModel\Entity\Attribute;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Item as ItemOrder;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{

    protected $itemOrder;
    protected $addFilterStrategies;

    protected $_map = [
        'fields' => [
            'director' => 'director.name',
            'actor' => 'actor.name',
            'movie_id' => 'main_table.movie_id',
            'rating' => 'main_table.rating',
            'name' => 'main_table.name',
            'description' => 'main_table.description'
        ]
    ];

    public function __construct(
        EntityFactory $entityFactory,
        Logger        $logger,
        FetchStrategy $fetchStrategy,
        EventManager  $eventManager,
        array         $addFilterStrategies = [],
                      $mainTable = 'magenest_movie',
                      $resourceModel = 'Magenest\Movie\Model\ResourceModel\Movie',
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
                ['director' => $this->getTable('magenest_director')],
                "main_table.director_id = director.director_id",
                ['director' => 'director.name']
            )
            ->joinLeft(
                ['movie_actor' => $this->getTable('magenest_movie_actor')],
                "main_table.movie_id = movie_actor.movie_id",
                ['movie_actor' => 'movie_actor.actor_id'])
            ->joinLeft(
                ['actor' => $this->getTable('magenest_actor')],
                "movie_actor.actor_id = actor.actor_id",
                ['actor' => new \Zend_Db_Expr('GROUP_CONCAT(actor.name)')])
            ->group('main_table.movie_id');
        return $this;
    }
}
