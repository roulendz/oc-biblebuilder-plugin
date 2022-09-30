<?php namespace Logingrupa\BibleBuilder\Classes\Store\Book;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;
use Logingrupa\BibleBuilder\Models\Book;
use Logingrupa\BibleBuilder\Classes\Store\BookListStore;

/**
 * Class SortingListStore
 * @package Logingrupa\BibleBuilder\Classes\Store\Book
 */
class SortingListStore extends AbstractStoreWithParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        switch ($this->sValue) {
            case BookListStore::SORT_CREATED_AT_ASC:
                $arElementIDList = $this->getByPublishASC();
                break;
            case BookListStore::SORT_CREATED_AT_DESC:
                $arElementIDList = $this->getByPublishDESC();
                break;
            default:
                $arElementIDList = $this->getDefaultList();
                break;
        }

        return $arElementIDList;
    }

    /**
     * Get default list
     * @return array
     */
    protected function getDefaultList() : array
    {
        $arElementIDList = (array) Book::pluck('book_number')->all();

        return $arElementIDList;
    }

    /**
     * Get sorting ID list by published (ASC)
     * @return array
     */
    protected function getByPublishASC() : array
    {
        $arElementIDList = (array) Book::orderBy('created_at', 'asc')->pluck('id')->all();

        return $arElementIDList;
    }

    /**
     * Get sorting ID list by published (DESC)
     * @return array
     */
    protected function getByPublishDESC() : array
    {
        $arElementIDList = (array) Book::orderBy('created_at', 'desc')->pluck('id')->all();

        return $arElementIDList;
    }
}
