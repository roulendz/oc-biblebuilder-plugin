<?php namespace Logingrupa\BibleBuilder\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Class Books
 * @package Logingrupa\BibleBuilder\Controllers
 */
class Books extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController',
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';

    /**
     * Books constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Logingrupa.BibleBuilder', 'biblebuilder-menu-main', 'biblebuilder-menu-books');
    }
}
