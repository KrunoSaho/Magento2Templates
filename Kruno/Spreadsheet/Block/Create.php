<?php
declare(strict_types=1);

namespace Kruno\Spreadsheet\Block;


class Create extends \Magento\Framework\View\Element\Template
{
    private $jsonHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $ctx,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        parent::__construct($ctx);

        $this->jsonHelper = $jsonHelper;
    }


    public function getModelData(): string {
        $data =  $this->escapeJs($this->jsonHelper->jsonEncode([
            'a' => 1,
            'b' => 2
        ]));

        return $data;
    }

}
