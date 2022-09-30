<?php namespace Logingrupa\BibleBuilder\Classes\Event\Book;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\BibleBuilder\Models\Book;
use Logingrupa\BibleBuilder\Classes\Item\BookItem;
use Logingrupa\BibleBuilder\Classes\Store\BookListStore;

/**
 * Class BookModelHandler
 * @package Logingrupa\BibleBuilder\Classes\Event\Book
 */
class BookModelHandler extends ModelHandler
{
    /** @var Book */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Book::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return BookItem::class;
    }
    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();

        $this->clearBySortingPublished();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        $this->clearBySortingPublished();
    }

    /**
     * Clear cache by created_at
     */
    protected function clearBySortingPublished()
    {
        BookListStore::instance()->sorting->clear(BookListStore::SORT_CREATED_AT_ASC);
        BookListStore::instance()->sorting->clear(BookListStore::SORT_CREATED_AT_DESC);
    }
}
