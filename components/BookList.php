<?php namespace Logingrupa\BibleBuilder\Components;

use Cms\Classes\ComponentBase;
use Logingrupa\BibleBuilder\Classes\Collection\BookCollection;

/**
 * Class BookList
 * @package Logingrupa\BibleBuilder\Components
 */
class BookList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.biblebuilder::lang.component.book_list_name',
            'description' => 'logingrupa.biblebuilder::lang.component.book_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return BookCollection
     */
    public function make($arElementIDList = null)
    {
        return BookCollection::make($arElementIDList);
    }

    /**
     * Method for ajax request with empty response
     * @return bool
     */
    public function onAjaxRequest()
    {
        return true;
    }
}
