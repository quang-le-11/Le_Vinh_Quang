<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class Showdata extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_collecton;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        array             $data = []
    ) {
        $this->_collecton = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magenest\Movie\Model\ResourceModel\Movie\Collection
     *
     */
    public function getMovie()
    {
        $movieCollection = $this->_collecton->create();
        $movieCollection->getSelect()
            ->join(
                ['director' => $movieCollection->getTable('magenest_director')],
                "main_table.director_id = director.director_id",
                ['director' => 'director.name']
            )
            ->join(
                ['movie_actor' => $movieCollection->getTable('magenest_movie_actor')],
                "main_table.movie_id = movie_actor.movie_id",
                ['movie_actor' => 'movie_actor.movie_id'])
            ->join(
                ['actor' => $movieCollection->getTable('magenest_actor')],
                "movie_actor.actor_id = actor.actor_id",
                ['actor' => new \Zend_Db_Expr('GROUP_CONCAT(actor.name)')])
            ->group('movie_id');

        return $movieCollection;
    }
}
