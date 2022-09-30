<?php namespace Logingrupa\BibleBuilder\Classes\Event\Chapter;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\BibleBuilder\Models\Chapter;
use Logingrupa\BibleBuilder\Classes\Item\ChapterItem;
use Logingrupa\BibleBuilder\Classes\Store\ChapterListStore;

/**
 * Class ChapterModelHandler
 * @package Logingrupa\BibleBuilder\Classes\Event\Chapter
 */
class ChapterModelHandler extends ModelHandler
{
    /** @var Chapter */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Chapter::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return ChapterItem::class;
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
        ChapterListStore::instance()->sorting->clear(ChapterListStore::SORT_CREATED_AT_ASC);
        ChapterListStore::instance()->sorting->clear(ChapterListStore::SORT_CREATED_AT_DESC);
    }
}
