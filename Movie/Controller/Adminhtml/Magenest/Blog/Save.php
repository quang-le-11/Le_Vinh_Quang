<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Blog;

use Magenest\Movie\Model\BlogFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    protected $blogFactory;

    public function __construct(
        Action\Context $context,
        BlogFactory $blogFactory
    ) {
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
        } else {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try {
            $actor->addData($newData);
            $actor->save();
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}
