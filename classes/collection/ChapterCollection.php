<?php namespace Logingrupa\BibleBuilder\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\BibleBuilder\Classes\Item\ChapterItem;
use Logingrupa\BibleBuilder\Classes\Store\ChapterListStore;

/**
 * Class ChapterCollection
 * @package Logingrupa\BibleBuilder\Classes\Collection
 */
class ChapterCollection extends ElementCollection
{
    const ITEM_CLASS = ChapterItem::class;

    /**
     * Sort list by
     * @param string $sSorting
     * @return $this
     */
    public function sort($sSorting)
    {
        $arResultIDList = ChapterListStore::instance()->sorting->get($sSorting);

        return $this->applySorting($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return ChapterItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return ChapterItem::make(null);
        }

        $arChapterList = $this->all();

        /** @var ChapterItem $obChapterItem */
        foreach ($arChapterList as $obChapterItem) {
            if ($obChapterItem->code == $sCode) {
                return $obChapterItem;
            }
        }

        return ChapterItem::make(null);
    }
}
