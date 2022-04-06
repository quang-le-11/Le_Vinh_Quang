<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Director;

use Magento\Backend\App\Action;
use Magenest\Movie\Model\DirectorFactory;


class Savedirector extends Action
{

    protected $directorFactory;

    public function __construct(
        Action\Context $context,
        DirectorFactory $directorFactory
    )
    {
        $this->directorFactory = $directorFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //        Lấy dữ liệu khi submit gửi lên
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['director_id']) ? $data['director_id'] : null;

        $newData = [
            'name' => $data['name'],
        ];

        $director = $this->directorFactory->create();
        if ($id) {
            $director->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        } else
        {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try {
            $director->addData($newData);
            $director->save();
            return $this->resultRedirectFactory->create()->setPath('movie/magenest_director/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}
