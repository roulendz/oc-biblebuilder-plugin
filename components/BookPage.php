<?php namespace Logingrupa\BibleBuilder\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Logingrupa\BibleBuilder\Models\Book;
use Logingrupa\BibleBuilder\Classes\Item\BookItem;

/**
 * Class BookPage
 * @package Logingrupa\BibleBuilder\Components
 */
class BookPage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'logingrupa.biblebuilder::lang.component.book_page_name',
            'description' => 'logingrupa.biblebuilder::lang.component.book_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Book
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Book::getBySlug($sElementSlug)->first();

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Book $obElement
     * @return BookItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return BookItem::make($iElementID, $obElement);
    }
}
