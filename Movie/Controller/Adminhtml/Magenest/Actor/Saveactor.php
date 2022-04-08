<?php

namespace Magenest\Movie\Controller\Adminhtml\Magenest\Actor;


use Magento\Backend\App\Action;
use Magenest\Movie\Model\ActorFactory;


class Saveactor extends Action
{

    protected $actorFactory;

    public function __construct(
        Action\Context $context,
        ActorFactory $actorFactory
    )
    {
        $this->actorFactory = $actorFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //        Lấy dữ liệu khi submit gửi lên
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['actor_id']) ? $data['actor_id'] : null;

        $newData = [
            'name' => $data['name'],
        ];

        $actor = $this->actorFactory->create();
        if ($id) {
            $actor->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        } else
        {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try {
            $actor->addData($newData);
            $actor->save();
            return $this->resultRedirectFactory->create()->setPath('movie/magenest_actor/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}
