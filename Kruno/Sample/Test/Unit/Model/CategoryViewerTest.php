<?php

namespace Kruno\Sample\Test\Unit\Model;

use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use \Magento\Catalog\Model\CategoryList;


class CategoryViewerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Kruno\Sample\Api\CategoryViewerInterface
    */
    protected $_model;


    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $catList = $objectManager->getObject(CategoryList::class);
        $this->_model = $objectManager->getObject(
            \Kruno\Sample\Model\CategoryViewer::class, 
            ['categoryListData' => $catList]
        );
    }


    public function testGetCompleteCategoryList()
    {
        $this->assertNotNull($this->_model);

        $data = [
            "Lens Adapters" => [
                'Nikon', 'FOTGA', 'Sony', 'Canon', 'Fujufilm', 
                'Leica', 'Olympus', 'Pentax', 'Konica'
            ],
            "Tripods & Monopods" => ["Heads", "Tripods", "Monopods"]
        ];
        $catList = $this->_model->getCompleteCategoryList();

        $this->assertNotEmpty($catList);
        $this->assertNotEquals($catList, $data);
    }
}
