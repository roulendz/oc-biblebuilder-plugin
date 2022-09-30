<?php namespace Logingrupa\BibleBuilder\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\BibleBuilder\Classes\Item\VerseItem;
use Logingrupa\BibleBuilder\Classes\Store\VerseListStore;

/**
 * Class VerseCollection
 * @package Logingrupa\BibleBuilder\Classes\Collection
 */
class VerseCollection extends ElementCollection
{
    const ITEM_CLASS = VerseItem::class;

    /**
     * Sort list by
     * @param string $sSorting
     * @return $this
     */
    public function sort($sSorting)
    {
        $arResultIDList = VerseListStore::instance()->sorting->get($sSorting);

        return $this->applySorting($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return VerseItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return VerseItem::make(null);
        }

        $arVerseList = $this->all();

        /** @var VerseItem $obVerseItem */
        foreach ($arVerseList as $obVerseItem) {
            if ($obVerseItem->code == $sCode) {
                return $obVerseItem;
            }
        }

        return VerseItem::make(null);
    }
}
