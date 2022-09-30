<?php namespace Logingrupa\BibleBuilder\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Logingrupa\BibleBuilder\Classes\Item\BookItem;
use Logingrupa\BibleBuilder\Classes\Store\BookListStore;

/**
 * Class BookCollection
 * @package Logingrupa\BibleBuilder\Classes\Collection
 */
class BookCollection extends ElementCollection
{
    const ITEM_CLASS = BookItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = BookListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Sort list by
     * @param string $sSorting
     * @return $this
     */
    public function sort($sSorting)
    {
        $arResultIDList = BookListStore::instance()->sorting->get($sSorting);

        return $this->applySorting($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return BookItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return BookItem::make(null);
        }

        $arBookList = $this->all();

        /** @var BookItem $obBookItem */
        foreach ($arBookList as $obBookItem) {
            if ($obBookItem->code == $sCode) {
                return $obBookItem;
            }
        }

        return BookItem::make(null);
    }
}
