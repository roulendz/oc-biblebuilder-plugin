<?php namespace Logingrupa\BibleBuilder\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Logingrupa\BibleBuilder\Classes\Store\Book\ActiveListStore;
use Logingrupa\BibleBuilder\Classes\Store\Book\SortingListStore;

/**
 * Class BookListStore
 * @package Logingrupa\BibleBuilder\Classes\Store
 * @property SortingListStore $sorting
 */
class BookListStore extends AbstractListStore
{
    const SORT_CREATED_AT_ASC  = 'created_at|asc';
    const SORT_CREATED_AT_DESC = 'created_at|desc';

    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('active', ActiveListStore::class);
        // $this->addToStoreList('sorting', SortingListStore::class);
    }
}
