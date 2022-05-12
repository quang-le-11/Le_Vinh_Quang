<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Blog;

use Magenest\Movie\Model\BlogFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    protected $blogFactory;
    protected $_urlRewriteFactory;

    public function __construct(
        Action\Context $context,
        BlogFactory $blogFactory,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory

    ) {
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->blogFactory = $blogFactory;
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

        $actor = $this->blogFactory->create();
        if ($id) {
            $actor->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        }
        try {
            $actor->addData($newData);
            $actor->save();
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));

            $urlRewrite = $this->_urlRewriteFactory->create();
            $page = array(
                'entity_type' => 'custom',
                'entity_id' => 39,
                'request_path' => $data['url_rewrite'],
                'target_path' => 'movie/blog/index/id/39',
            );
            $urlRewrite->setData($page);
            $urlRewrite->save();
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
