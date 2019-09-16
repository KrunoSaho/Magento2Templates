<?php
/**
 * @author Krunoslav Saho
*/
declare(strict_types=1);

namespace Kruno\Sample\Api;

/**
 * @api
 * @since 0.0.1
*/
interface CategoryViewerInterface
{
    public function getCompleteCategoryList(): array;
}
