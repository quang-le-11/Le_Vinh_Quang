<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Star extends Column
{
    protected $escaper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        Escaper            $escaper,
        array              $components = [],
        array              $data = []
    ) {
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $html = $this->getStar($item['rating']);
                $item['rating'] = $this->escaper->escapeHtml($html, ['i']);
            }
        }
        return $dataSource;
    }

    /**
     * @param $rating
     * @return string|null
     */
    public function getStar($rating)
    {
        $html = null;
        $i = 0;
        for (; $i < $rating; $i++) {
            $html .= '<i class="star" style="color: yellow">&#9733;</i>';
        }
        for (; $i < 5; $i++) {
            $html .= '<i class="star" >&#9734;</i>';
        }
        return $html;
    }
}
