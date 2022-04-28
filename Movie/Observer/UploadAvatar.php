<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magenest\Movie\Model\CalendarFactory;

class UploadAvatar implements ObserverInterface
{
    protected $calendarFactory;

    /**
     * @param CalendarFactory $calendarFactory
     */
    public function __construct(
        CalendarFactory $calendarFactory
    ) {
        $this->calendarFactory = $calendarFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $data = $observer->getData('product');
        $idProduct = !empty($data['entity_id']) ? $data['entity_id'] : null;
        $calendarCollection = $this->calendarFactory->create();

        if ($data['entity_id'] !== null) {
            $newData = [
                'product_id' => $data['entity_id']
            ];
        }

        try {
            $calendar = $data['calendar_fieldset']['options'][0];
            $newData['calendar'] = $calendar['title'];
            if (isset($calendar['image_upload']) && is_array($calendar['image_upload'])) {
                $strpos = strpos($calendar['image_upload'][0]['url'], '/media/');
                $calendar['image_upload'][0]['url'] = substr($calendar['image_upload'][0]['url'], $strpos + 6);
                $calendar['image_upload'][0]['url'] = trim($calendar['image_upload'][0]['url'], '/');
                $newData['uploadCalendar'] = json_encode($calendar['image_upload']);
            }
            $calendarCollection->addData($newData);
            $calendarCollection->save();
        } catch (\Exception $e) {
        }
    }
}
