<?php

namespace Magenest\Notification\Controller\Adminhtml\Notification;

use Magenest\Notification\Model\PromoFactory;
use Magento\Backend\App\Action;

class SaveNotification extends Action
{
    /**
     * @var PromoFactory
     */
    private $promoFactory;

    /**
     * @param Action\Context $context
     * @param PromoFactory $promoFactory
     */
    public function __construct(
        Action\Context $context,
        PromoFactory   $promoFactory
    ) {
        $this->promoFactory = $promoFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        //Lay data
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['entity_id']) ? $data['entity_id'] : null;

        $newData = [
            'name'=> $data['name'],
            'status' =>$data['status'],
            'created_at' => $data['created_at'],
            'short_description'=>$data['short_description'],
            'redirect_url'=>$data['redirect_url']
        ];

        $promo = $this->promoFactory->create();
        if ($id) {
            $promo->load($id);
            $this->messageManager->addSuccessMessage(__('Edit thành công.'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('Save thành công.'));
        }
        try {
            $promo->addData($newData);
            $promo->save();
            return $this->resultRedirectFactory->create()->setPath('notification/notification/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}
