<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableNameDirector = $installer->getTable('magenest_director');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tableNameDirector) != true) {
            $table = $installer->getConnection()
                ->newTable($tableNameDirector)
                ->addColumn(
                    'director_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'director_id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'name'
                )
                //Set comment for magetop_blog table
                ->setComment('Magenset Movie Table')
                //Set option for magetop_blog table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);;
        }

        $tableNameActor = $installer->getTable('magenest_actor');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tableNameActor) != true) {
            $table = $installer->getConnection()
                ->newTable($tableNameActor)
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'actor_id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'name'
                )
                //Set comment for magetop_blog table
                ->setComment('Magenset Movie Table')
                //Set option for magetop_blog table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);;
        }

        $tableNameMovie = $installer->getTable('magenest_movie');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tableNameMovie) != true) {
            $table = $installer->getConnection()
                ->newTable($tableNameMovie)
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'movie_id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false', 'default' => ''],
                    'name'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'description'
                )
                ->addColumn(
                    'rating',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false,],
                    'rating'
                )
                ->addColumn(
                    'director_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['unsigned' => true, 'nullable' => false, 'index' => true],
                    'director_id'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'magenest_movie',
                        'director_id',
                        'magenest_director',
                        'director_id'
                    ),
                    'director_id',
                    $installer->getTable('magenest_director'),
                    'director_id',
                    Table::ACTION_CASCADE
                )
                //Set comment for magetop_blog table
                ->setComment('Magenset Movie Table')
                //Set option for magetop_blog table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);;
        }

        $tableNameMovieActor = $installer->getTable('magenest_movie_actor');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tableNameMovieActor) != true) {
            $table = $installer->getConnection()
                ->newTable($tableNameMovieActor)
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['unsigned' => true, 'nullable' => false, 'index' => true],
                    'movie_id'
                )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['unsigned' => true, 'nullable' => false, 'index' => true],
                    'actor_id'
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'magenest_movie_actor',
                        'movie_id',
                        'magenest_movie',
                        'movie_id'),
                    'movie_id',
                    $setup->getTable('magenest_movie'),
                    'movie_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'magenest_movie_actor',
                        'actor_id',
                        'magenest_actor',
                        'actor_id'),
                    'actor_id',
                    $setup->getTable('magenest_actor'),
                    'actor_id',
                    Table::ACTION_CASCADE
                )

                //Set comment for magetop_blog table
                ->setComment('Magenset Movie Table')
                //Set option for magetop_blog table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);;
        }
        $installer->endSetup();
    }
}
