<?php namespace Logingrupa\BibleBuilder\Classes\Store\Verse;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithParam;
use Logingrupa\BibleBuilder\Models\Verse;
use Logingrupa\BibleBuilder\Classes\Store\VerseListStore;

/**
 * Class SortingListStore
 * @package Logingrupa\BibleBuilder\Classes\Store\Verse
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
            case VerseListStore::SORT_CREATED_AT_ASC:
                $arElementIDList = $this->getByPublishASC();
                break;
            case VerseListStore::SORT_CREATED_AT_DESC:
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
        $arElementIDList = (array) Verse::pluck('id')->all();

        return $arElementIDList;
    }

    /**
     * Get sorting ID list by published (ASC)
     * @return array
     */
    protected function getByPublishASC() : array
    {
        $arElementIDList = (array) Verse::orderBy('created_at', 'asc')->pluck('id')->all();

        return $arElementIDList;
    }

    /**
     * Get sorting ID list by published (DESC)
     * @return array
     */
    protected function getByPublishDESC() : array
    {
        $arElementIDList = (array) Verse::orderBy('created_at', 'desc')->pluck('id')->all();

        return $arElementIDList;
    }
}
