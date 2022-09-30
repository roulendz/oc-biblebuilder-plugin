<?php namespace Logingrupa\BibleBuilder\Classes\Store\Collection;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Logingrupa\BibleBuilder\Models\Book;
use Logingrupa\BibleBuilder\Classes\Store\BookListStore;

/**
 * Class ActiveListStore
 * @package Logingrupa\BibleBuilder\Classes\Store\Collection
 */
class ActiveListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB(): array
    {
        $arElementIDList = (array)Book::active()->lists('id');

        return $arElementIDList;
    }
}