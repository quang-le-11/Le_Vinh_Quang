<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Blog;

use Magenest\Movie\Model\BlogFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    protected $blogFactory;
    protected $_urlRewriteFactory;
    protected $blogRepository;

    public function __construct(
        Action\Context $context,
        BlogFactory $blogFactory,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory,
        \Magenest\Movie\Model\BlogRepository $blogRepository
    ) {
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->blogFactory = $blogFactory;
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        //        Lấy dữ liệu khi submit gửi lên
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['id']) ? $data['id'] : null;

        $newData = [
            'author_id' => 1,
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'url_rewrite' => $data['url_rewrite'],
            'status' => $data['status'],
            'create_at' => '2022-05-11 14:53:03',
            'update_at' => '2022-05-11 14:53:03'
        ];

        $blog = $this->blogFactory->create();
        if ($id) {
            $blog->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        }
        try {
            $blog->addData($newData);
//            $blog->save();p
            $this->blogRepository->save($blog);
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));

            $urlRewrite = $this->_urlRewriteFactory->create();
            $page = [
                'entity_type' => 'custom',
                'entity_id' => $blog['id'],
                'request_path' => $data['url_rewrite'],
                'target_path' => 'movie/blog/view/id/' . $blog['id'],
                'store_id' => 1
            ];
            $urlRewrite->setData($page);
            $urlRewrite->save();
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
