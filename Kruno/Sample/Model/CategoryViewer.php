<?php
declare(strict_types=1);

namespace Kruno\Sample\Model;


class CategoryViewer implements \Kruno\Sample\Api\CategoryViewerInterface
{
    /**
     * @var \Magento\Catalog\Api\CategoryListInterface
    */
    private $_categoryListData;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
    */
    private $_searchCriteriaBuilder;
    

    public function __construct(
        \Magento\Catalog\Api\CategoryListInterface $categoryListData,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->categoryListData = $categoryListData;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    }


    public function getCompleteCategoryList(): array
    {
        $searchCrit = $this->_searchCriteriaBuilder->create();
        $results = $this->_categoryListData->getList($searchCrit);
        $data = [];

        foreach ($results->getItems() as $item) {
            $data[] = $item->__toArray();
        }
        return $data;
    }
    
}
