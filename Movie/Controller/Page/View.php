<?php
declare(strict_types=1);

namespace Magenest\Movie\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;


class View extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
       return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
