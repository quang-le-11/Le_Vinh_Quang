<?php

namespace Magenest\Movie\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magenest\Movie\Model\MovieFactory;

class SaveMovie extends Action
{
    private $movieFactory;

    public function __construct(
        Action\Context $context,
        MovieFactory   $movieFactory
    ) {
        parent::__construct($context);
        $this->movieFactory = $movieFactory;
    }

    public function execute()
    {
//        Lấy dữ liệu khi submit gửi lên
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['movie_id']) ? $data['movie_id'] : null;

        $newData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'rating' => $data['rating'],
            'director_id' => 4
        ];

        $movie = $this->movieFactory->create();
        if ($id) {
            $movie->load($id);
        }
        try {
            $movie->addData($newData);
            $movie->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('movie/index/index');
    }
}
