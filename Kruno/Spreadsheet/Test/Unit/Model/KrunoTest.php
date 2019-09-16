<?php
/**
 * 
*/

declare(strict_types=1);

namespace Kruno\Spreadsheet\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;


/**
 * Class KrunoTest
 * @package Kruno\Spreadsheet\Test\Unit\Model;
 */
class KrunoTest extends TestCase
{
    /**
     * @var Kruno\Spreadsheet\Api\RowRepositoryInterface
     */
    protected $rowRepository;


    public function setUp() {
        $this->objectManager = new ObjectManager($this);

        // Create the result of outer factory
        $row = $this->createPartialMock(\Kruno\Spreadsheet\Api\Data\RowInterface::class, ['getRow']);
        $row->expects($this->once())->method('getRow')->willReturn(324);

        // Our factory
        $factory = $this->createPartialMock('\Kruno\Spreadsheet\Api\Data\RowInterfaceFactory', ['create']);
        $factory->expects($this->once())->method('create')->willReturn($row);

        // The Repository
        $this->rowRepository = $this->objectManager->getObject(\Kruno\Spreadsheet\Model\RowRepository::class, [
            'rowFactory' => $factory
        ]);
    }


    public function testGet()
    {
        $row = $this->rowRepository->get(0);
        $this->assertNotNull($row);

        $this->assertEquals($row->getRow(), 324);
    }
}
