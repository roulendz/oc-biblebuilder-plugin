<?php namespace Logingrupa\BibleBuilder\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Logingrupa\BibleBuilder\Model\Book;
use Logingrupa\BibleBuilder\Model\Chapter;

/**
 * GenerateTranslation Command
 */
class GenerateTranslation extends Command
{
    /**
     * @var string name is the console command name
     */
    protected $name = 'biblebuilder:generatetranslation';

    /**
     * @var string description is the console command description
     */
    protected $description = 'No description provided yet...';

    /**
     * handle executes the console command
     */
    public function handle()
    {
        
        $this->output->writeln('Hello world!');
    }

    /**
     * getArguments get the console command arguments
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * getOptions get the console command options
     */
    protected function getOptions()
    {
        return [];
    }
}
