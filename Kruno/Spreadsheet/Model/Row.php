<?php

namespace Kruno\Spreadsheet\Model;


class Row implements \Kruno\Spreadsheet\Api\Data\RowInterface 
{
    private $rowNo;

    /**
     * Constructor
    */
    public function __construct(int $rowNo)
    {
        $this->rowNo = $rowNo;
    }

    /**
     * Get the row number.
     * 
     * @return row number
     */
    public function getRow() {
        return $this->rowNo;
    }

}
