<?php namespace Logingrupa\BibleBuilder;

use Event;
use Config;
use System\Classes\PluginBase;
use Logingrupa\BibleBuilder\Classes\Event\Book\BookModelHandler;
use Logingrupa\BibleBuilder\Classes\Event\Verse\VerseModelHandler;
use Logingrupa\BibleBuilder\Classes\Event\Chapter\ChapterModelHandler;

/**
 * Class Plugin
 * @package Logingrupa\BibleBuilder
 */
class Plugin extends PluginBase
{
    /** @var array Plugin dependencies */
    public $require = ['Lovata.Toolbox'];

    /**
     * Plugin boot method
     */
    public function boot()
    {
        $this->addEventListener();
    }

    /**
     * Add event listeners
     */
    protected function addEventListener()
    {
        //Book events
        Event::subscribe(BookModelHandler::class);
        //Chapter events
        Event::subscribe(ChapterModelHandler::class);
        Event::subscribe(VerseModelHandler::class);

    }

    public function register()
    {
        $this->registerConsoleCommand('biblebuilder:generatetranslation', \Logingrupa\BibleBuilder\Console\GenerateTranslation::class);
    }
}
