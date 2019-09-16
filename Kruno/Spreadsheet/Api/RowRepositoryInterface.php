<?php
declare(strict_types=1);

namespace Kruno\Spreadsheet\Api;

/**
 * @api
 * @since 0.0.1
 */
interface RowRepositoryInterface {
    /**
     * Get data for the row.
     * 
     * @param $rowNo The row number from 0 -> N
     * @return \Kruno\Spreadsheet\Api\Data\RowInterface
     */
    public function get(int $rowNo);
}
