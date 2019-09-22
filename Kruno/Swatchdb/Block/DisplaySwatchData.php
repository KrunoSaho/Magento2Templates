<?php

namespace Kruno\SwatchDb\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;


class DisplaySwatchData extends Template
{
    const CONFIG_PATH = 'krunoswatchdb/category_group/select_category';

    /**
     * @var \Magento\Framework\App\Config
    */
    private $config;

    /**
     * @var CategoryRepositoryInterface
    */
    private $categoryRepo;

    /**
     * @var ProductRepositoryInterface
    */
    private $productRepo;

    /**
     * @var \Magento\Swatches\Helper\Data
    */
    private $swatchDataHelper;

    /**
     * @var \Magento\Swatches\Helper\Media
    */
    private $swatchMediaHelper;

    /**
     * @var \Magento\Swatches\Model\SwatchFactory
    */
    private $swatchFac;


    public function __construct(
        Context $context,
        ScopeConfigInterface $config,
        CategoryRepositoryInterface $categoryRepo,
        ProductRepositoryInterface $productRepo,
        \Magento\Swatches\Helper\Data $swatchDataHelper,
        \Magento\Swatches\Helper\Media $swatchMediaHelper,
        \Magento\Swatches\Model\SwatchFactory $swatchFac,
        array $data = []
    )
    {
        parent::__construct($context, $data);

        $this->config = $config;
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
        $this->swatchDataHelper = $swatchDataHelper;
    }


    public function getCategorySwatchData()
    {
        $categoryId = $this->config->getValue(DisplaySwatchData::CONFIG_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $category = $this->categoryRepo->get((int)$categoryId);
        
        // get product
        $productId = $this->getRequest()->getParam('id');
        $product = $this->productRepo->getById($productId);

        // get swatch
        $swatchId = $product->getCustomAttribute('swatchdb');
        $swatchData = $this->swatchDataHelper->getSwatchesByOptionsId([$swatchId->getValue()]);
        if (empty($swatchData)) {
            return '';
        }

        $url = array_shift($swatchData)['value'];

        return $url;
    }

}
