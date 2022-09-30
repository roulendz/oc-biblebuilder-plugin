<?php namespace Logingrupa\BibleBuilder\Classes\Event\Verse;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Logingrupa\BibleBuilder\Models\Verse;
use Logingrupa\BibleBuilder\Classes\Item\VerseItem;
use Logingrupa\BibleBuilder\Classes\Store\VerseListStore;

/**
 * Class VerseModelHandler
 * @package Logingrupa\BibleBuilder\Classes\Event\Verse
 */
class VerseModelHandler extends ModelHandler
{
    /** @var Verse */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Verse::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return VerseItem::class;
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
        VerseListStore::instance()->sorting->clear(VerseListStore::SORT_CREATED_AT_ASC);
        VerseListStore::instance()->sorting->clear(VerseListStore::SORT_CREATED_AT_DESC);
    }
}
