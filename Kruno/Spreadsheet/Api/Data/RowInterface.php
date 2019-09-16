<?php

namespace Kruno\Spreadsheet\Api\Data;

/**
 * @api
 * @since 0.0.1
 */
interface RowInterface {
    /**
     * Get the row number.
     * 
     * @return row number
     */
    public function getRow();
}
