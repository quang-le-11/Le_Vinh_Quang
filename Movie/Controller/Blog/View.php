<?php

namespace Magenest\Movie\Controller\Blog;

use Magenest\Movie\Model\BlogRepository;


class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $blogRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        BlogRepository $blogRepository
    ) {
        $this->_pageFactory = $pageFactory;
        $this->blogRepository = $blogRepository;
        return parent::__construct($context);
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        /** @var \Magenest\Movie\Api\Data\BlogInterface $as */
//        $as = $this->blogRepository->getById(41);
        return $this->_pageFactory->create();
    }
}
