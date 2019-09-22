<?php

namespace Kruno\SwatchDb\Model\Config;

use Magento\Catalog\Api\CategoryListInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Option\ArrayInterface;

class CategoryList implements ArrayInterface
{

    /**
     * @var CategoryRepositoryInterface
    */
    private $categoryRepo;


    public function __construct(
        CategoryRepositoryInterface $categoryRepo
    )
    {
        $this->categoryRepo = $categoryRepo;
    }


    private function getCategoryRoots()
    {
        $ROOT_CAT_ID = 1;
        $kidList = $this->categoryRepo->get($ROOT_CAT_ID)->getChildren();
        $kidIds = explode(',', $kidList);

        $data = [];
        
        foreach ($kidIds as $id) {
            $node = $this->categoryRepo->get((int)$id);
            $data[] = [
                'value' => $node->getId(),
                'label' => $node->getName()
            ];
        }

        return $data;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray() 
    {
        return $this->getCategoryRoots();
    }
}
