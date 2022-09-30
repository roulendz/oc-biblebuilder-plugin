<?php namespace Logingrupa\BibleBuilder\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Logingrupa\BibleBuilder\Classes\Item\BookItem;

/**
 * Class BookData
 * @package Logingrupa\BibleBuilder\Components
 */
class BookData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.biblebuilder::lang.component.book_data_name',
            'description' => 'logingrupa.biblebuilder::lang.component.book_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return BookItem
     */
    protected function makeItem($iElementID)
    {
        return BookItem::make($iElementID);
    }
}
