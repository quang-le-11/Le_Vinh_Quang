<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Blog;

use Magenest\Movie\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magenest\Movie\Model\BlogRepository;

class Delete extends Action
{
    private $filter;
    private $collectionFactory;
    private $resultRedirect;
    protected $blogRepository;

    /**
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param RedirectFactory $redirectFactory
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        Action\Context    $context,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory   $redirectFactory,
        BlogRepository $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;

    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        foreach ($collection->getItems() as $item) {
            $this->blogRepository->deleteById($item->getData('id'));
        }
        return $this->resultRedirect->create()->setPath('movie/magenest_blog/index');
    }
}
