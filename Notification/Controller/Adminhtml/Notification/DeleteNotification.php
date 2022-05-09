<?php

namespace Magenest\Notification\Controller\Adminhtml\Notification;

use Magenest\Notification\Model\ResourceModel\Promo\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class DeleteNotification extends Action
{
//    const ADMIN_RESOURCE = "Megenest_Notification::notification_delete";
    /**
     * @var \Magenest\Notification\Model\ResourceModel\Promo\Collection
     */
    protected $collectionFactory;
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @param Action\Context $context
     * @param CollectionFactory $collectionFactory
     * @param Filter $filter
     */
    public function __construct(
        Action\Context $context,
        CollectionFactory $collectionFactory,
        Filter $filter
    ) {
        $this->collectionFactory =$collectionFactory->create();
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory);
        $collectionSize = $collection->getSize();

        foreach ($collection as $news) {
            $news->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
