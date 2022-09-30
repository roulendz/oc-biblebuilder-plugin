<?php namespace Logingrupa\BibleBuilder\Classes\Item;

use Cms\Classes\Page as CmsPage;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Logingrupa\BibleBuilder\Models\Chapter;

/**
 * Class ChapterItem
 * @package Logingrupa\BibleBuilder\Classes\Item
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class ChapterItem extends ElementItem
{
    const MODEL_CLASS = Chapter::class;

    /** @var Chapter */
    protected $obElement = null;

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'chapter')
    {
        //Get URL params
        $arParamList = $this->getPageParamList($sPageCode);

        //Generate page URL
        $sURL = CmsPage::url($sPageCode, $arParamList);

        return $sURL;
    }

    /**
     * Get URL param list by page code
     * @param string $sPageCode
     * @return array
     */
    public function getPageParamList($sPageCode) : array
    {
        $arPageParamList = [];

        //Get URL params for page
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'ChapterPage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }
}
