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
            'director_id' => $data['director_id']
        ];

        $movie = $this->movieFactory->create();
        if ($id) {
            $movie->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        } else
        {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try {
            $movie->addData($newData);
            $this->_eventManager->dispatch("meagenest_movie_before_save", ['movieData' => $movie]);
            $movie->save();
            //$this->messageManager->addSuccessMessage(__('You saved the post.'));
            return $this->resultRedirectFactory->create()->setPath('movie/index/index');
        } catch (\Exception $e) {
           // $this->messageManager->addErrorMessage(__($e->getMessage()));
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
        //return $this->resultRedirectFactory->create()->setPath('movie/index/index');
    }
}
