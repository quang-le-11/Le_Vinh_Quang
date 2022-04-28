<?php

namespace Magenest\Movie\Controller\Adminhtml\Export;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class OderItem extends \Magento\Backend\App\Action
{
    protected $directory;
    protected $fileFactory;
    protected $orderCollectionFactory;

    /**
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Context                                                    $context,
        FileFactory                                                $fileFactory,
        \Magento\Framework\Filesystem                              $filesystem,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function execute()
    {
        $filepath = 'export/customerlist.csv';
        $this->directory->create('export');
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();

        $header = ['Id', 'sku', 'name'];
        $stream->writeCsv($header);

        $oderCollection = $this->orderCollectionFactory->create();
        $oderCollection->getSelect()
            ->joinLeft(
                ['itemProduct' => $oderCollection->getTable('sales_order_item')],
                "main_table.entity_id = itemProduct.order_id",
            )
            ->group('entity_id');

        foreach ($oderCollection as $item) {
            $data = [];
            $data[] = $item->getData('entity_id');
            $data[] = $item->getData('sku');
            $data[] = $item->getData('name');
            $stream->writeCsv($data);
        }

        $content = [];
        $content['type'] = 'filename'; // must keep filename
        $content['value'] = $filepath;
        $content['rm'] = '1'; //remove csv from var folder
        $csvfilename = 'Product.csv';

        return $this->fileFactory->create(
            $csvfilename,
            $content,
            DirectoryList::VAR_DIR
        );
    }
}
