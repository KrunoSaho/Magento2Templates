<?php
/**
 * 
*/

declare(strict_types=1);

namespace Kruno\Spreadsheet\Model;


/**
 * @api
 * @since 0.0.1
 * @author <cat.dog@gmail.com>
*/
class RowRepository implements \Kruno\Spreadsheet\Api\RowRepositoryInterface
{

    /**
     * @var \Kruno\Spreadsheet\Api\Model\RowFactory
    */
    private $rowFactory;

    /**
     * 
    */
    public function __construct(
        \Kruno\Spreadsheet\Api\Data\RowInterfaceFactory $rowFactory
    )
    {
        $this->rowFactory = $rowFactory;
    }


    /**
     * Get data for the row.
     * 
     * @param rowNo The row number from 0 -> N
     * @return \Kruno\Spreadsheet\Api\Data\RowInterface
     */
    public function get(int $rowNo)
    {
        return $this->rowFactory->create(['rowNo' => $rowNo]);
    }
}
