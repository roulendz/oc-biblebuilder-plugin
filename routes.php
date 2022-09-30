<?php
use Illuminate\Support\Facades\Http;
use Logingrupa\BibleBuilder\Models\Book;
use Logingrupa\BibleBuilder\Models\Verse;
use Logingrupa\BibleBuilder\Models\Chapter;
use Logingrupa\BibleBuilder\Classes\Collection\BookCollection;
use Logingrupa\BibleBuilder\Components\BookList;

Route::get('/v1/generate', function() {
    // $chapters = Chapter::with('book')->groupBy('book_number')->get();
    // dd($chapters);
// foreach ($chapters as $chapter) {
//     echo $chapter;
//     // echo $chapter->book_number . ' ' . $chapter->verse . ' '. $chapter->text;
// }


    $books = Book::find(['10', '20']);
    // dd($books);
    foreach ($books as $book) {
        $bookName = 'bible5/'.$book->long_name;
        $chapterName = $book->short_name;
        // echo $book->short_name . '<br>'; 
        // Get All book Verses
        $verses = Chapter::where('book_number', '=', $book->book_number )->get();
        // Group verses by chapters of current boook
        $chapters = $verses->groupBy('chapter');
        // dd($chapters);
        foreach ($verses as $verses) {
            Storage::append($bookName . '/' . $chapterName . ' ' . $verses['chapter'] .'.md', $verses['book_number'] . ' '. $verses['chapter'] . ' ###### ' . $verses['verse'] . ' ' . $verses['text']);
            // echo $verses['book_number'] . ' '. $verses['chapter'] . ' ' . $verses['verse'] . ' ' . $verses['text'] . '<br>';
        }
    
        // Storage::put(' ' . $chapter->chapter . '.md', $book->short_name . ' ' . $chapter->chapter . '###### ' . $chapter->verse . ' ' . $chapter->text);
        // foreach ($chapters as $chapter) {
        //     // echo $book->short_name . ' ' .$chapter->chapter . '-' . $chapter->verse . ' ' . $chapter->text . '<br>';
        // }
        // Storage::put( 'bible/' . $book->long_name . '/' . $book->long_name . '.md', '$book->chapters->id');
    }
    
});

Route::get('/v2/generate', function() {
    // $chapters = Chapter::with('book')->groupBy('book_number')->get();
    // dd($chapters);
// foreach ($chapters as $chapter) {
//     echo $chapter;
//     // echo $chapter->book_number . ' ' . $chapter->verse . ' '. $chapter->text;
// }


    $books = Book::find(['10', '20']);
    // dd($books);
    $result = [];
    foreach ($books as $book) {
        $result[$book->short_name] = [];
        $bookName = 'bible5/'.$book->long_name;
        $chapterName = $book->short_name;
        //
        
        // Get All book Verses
        $verses = Chapter::where('book_number', '=', $book->book_number )->get();
        // Group verses by chapters of current boook
        $chapterCount = Chapter::groupBy('chapter')->where('book_number', '=', $book->book_number )->get();
        $i = 0;
        $maxiterations = $chapterCount->count();
        $chapters = Chapter::where('book_number', '=', $book->book_number )->where('chapter', '=', $i)->groupBy('chapter')->get();
            // var_dump($chapters->toJson());
            
            // var_dump($chapterCount->toJson());
            foreach ($verses as $verse) {
                $i = 0;
                $maxiterations = $chapterCount->count();
                $chapters = Chapter::where('book_number', '=', $book->book_number )->where('chapter', '=', $i)->groupBy('chapter')->get();
            // echo $verse;
                if ($i < $maxiterations) {
                    $result[$book->short_name][] = $verse['id'];
                    $i++;
                } else  {  // Jump out of the loop if we hit the maximum
                    break;
                }
            }
      

        dd($result);
    }

});

Route::get('/v3/generate', function() {
    $book = Book::find(10);
    $books = Book::find(['10', '20']);
    $onlyChapters = $book->chapters()->where('book_number', '=', $book->book_number)->groupChapters()->get();

    $result = [];
    foreach ($books as $book) {
        $result[]= [$book->short_name];
        $bookName = 'bible7/'.$book->long_name;
        $chapterName = $book->short_name;
        // dd($onlyChapters);
        // return $chapters;
        // echo $book->long_name . '<br>';
        foreach ($onlyChapters as $onlyChapter) {
            // echo ' #C' . $onlyChapter->chapter . '<br>';
            $result[][] = ['chapter' => $onlyChapter->chapter];
            $verses = Verse::where('book_number', '=', $book->book_number)->where('chapter','=', $onlyChapter->chapter)->get();
            // return $chapters;
            // foreach ($chapters as $chapter) {
                
                foreach ($verses as $key=>$verse) {
                    $result[][][] = ['verse' => $verse->chapter, 'text' => $verse->text];
                    // $result = [$verse->cerse] = $verse->text;
                    // Storage::append($bookName . '/' . $chapterName . ' ' . $verse->chapter .'.md', '###### V' . $verse->verse . ' ' . $verse->text);
                    // echo $key . '###### V' . $verse->verse . ' ' . $verse->text . '<br>';
                }
            // }
        }
    }

   return $result;
    // return Chapter::find(1);

});

Route::get('/v3/generate', function() {
    $book = Book::find(10);
    $books = Book::all();
    $onlyChapters = $book->chapters()->where('book_number', '=', $book->book_number)->groupChapters()->get();

    $result = [];
    foreach ($books as $book) {
        $result[]= [$book->short_name];
        $bookName = 'bible7/'.$book->long_name;
        $chapterName = $book->short_name;
        // dd($onlyChapters);
        // return $chapters;
        // echo $book->long_name . '<br>';
        foreach ($onlyChapters as $onlyChapter) {
            // echo ' #C' . $onlyChapter->chapter . '<br>';
            $result[][] = ['chapter' => $onlyChapter->chapter];
            $verses = Verse::where('book_number', '=', $book->book_number)->where('chapter','=', $onlyChapter->chapter)->get();
            // return $chapters;
            // foreach ($chapters as $chapter) {
                
                foreach ($verses as $key=>$verse) {
                    $result[][][] = ['verse' => $verse->chapter, 'text' => $verse->text];
                    // $result = [$verse->cerse] = $verse->text;
                    // Storage::append($bookName . '/' . $chapterName . ' ' . $verse->chapter .'.md', '###### V' . $verse->verse . ' ' . $verse->text);
                    // echo $key . '###### V' . $verse->verse . ' ' . $verse->text . '<br>';
                }
            // }
        }
    }

   return $result;
    // return Chapter::find(1);

});

Route::prefix('/v4/generate')->group(function () {
    // LEGACY
    Route::get('book/{id}/{chapter}', function ($id, $chapter){
        function transaltion($str) {
            $ret = '';
            foreach (explode(' ', $str) as $word)
                $ret .= strtoupper($word[0]);
            return $ret;
        }
        \DB::enableQueryLog();
        $bookModel = Book::where('book_number', '=', $id)->first();
        $chapterModel = Chapter::where('chapter', '=', $chapter)->first()->toSql();
        $chapterCount = Chapter::where('book_number', '=', $id)->groupChapters()->get()->count();
        $verses = Verse::where('book_number', '=', $id)->where('chapter', '=', $chapter)->get();
        $infoTable = DB::table('info')->get()->pluck('value', 'name');
        $bibleTransaltion = explode (",", $infoTable['description']);
        // dd($chapterCount);
        dd(\DB::getQueryLog());

        $currentChapter = $chapter;
        $prevChapter = ($currentChapter == 1) ? $bookModel->long_name : $bookModel->short_name . ' ' . $chapter - 1;
        $nextChapter = ($currentChapter == $chapterCount) ? $bookModel->long_name : $bookModel->short_name . ' ' . $chapter + 1;

        $prevChapterLong = ($currentChapter == 1) ? $bookModel->long_name : $bookModel->long_name . ' ' . $chapter - 1;
        $nextChapterLong = ($currentChapter == $chapterCount) ? $bookModel->long_name : $bookModel->long_name . ' ' . $chapter + 1;

        // dd($infoTable);
        $data = [
        'book' => [
                'book_number' => $bookModel->book_number,
                'short_name' => $bookModel->short_name,
                'long_name' => $bookModel->long_name,
                'max_chapter' => $chapterCount,
                'verse_count' => $verses->count(),
                'translation' => transaltion($bibleTransaltion[0]),
            ],
        'chapter' => [
                'prev_chapter' => $prevChapter,
                'next_chapter' => $nextChapter,
                'prev_chapter_long' => $prevChapterLong,
                'next_chapter_long' => $nextChapterLong,
                'current_chapter' => $chapterModel->chapter,
                'verse_count' => $verses->count(),
            ],
        'verses' => $verses->toArray(),
        'info' => $infoTable,
        ];
        // dd($data);
        return View::make('logingrupa.biblebuilder::single_chapter_and_verses')->with('data', $data);
            // dd('/'.$book->book_number);
    });

    // DONE - Generate list of all Chapters for specific book of The Bible
    // https://bibele.test/v4/generate/translation/NKJV/book/10
    Route::get('translation/{db_name}/book/{id}', ['as' => 'book_chapter_index', function ($db_name, $id){
        DB::purge('sqlite'); 
        Config::set(["database.connections.sqlite.database" => "storage/".$db_name.".SQLite3"]);
        // DB::reconnect('sqlite');
        // Schema::connection('sqlite')->getConnection()->reconnect();

        $bookModel = DB::table('books')->where('book_number', '=', $id)->first();

        $chapterCount = DB::table('verses')->where('book_number', '=', $id)->groupBy('chapter')->get()->count();
        $chapters = DB::table('verses')->where('book_number', '=', $id)->groupBy('chapter')->get();
        $infoTable = DB::table('info')->get()->pluck('value', 'name');
        $arBibleSettings = config('logingrupa.biblebuilder::bible_translation_settings');
        $sColumnName = $arBibleSettings[$db_name]['chapter_language_column'];
        $addAcronym = ($arBibleSettings[$db_name]['add_chapter_acronym'] == 'true') ? $db_name.' ' : '';
        $data = [
           'book' => [
                'book_number' => $bookModel->book_number,
                'short_name' => $bookModel->$sColumnName,
                'long_name' => $bookModel->long_name,
                'max_chapter' => $chapterCount,
                'translation' => $db_name,
                'acronym' => $addAcronym,
                'tags' => str_slug($bookModel->$sColumnName, '-'). ', ' . str_slug($bookModel->short_name_en, '-'),
            ],
            'chapters' => $chapters->toArray(),
            'info' => $infoTable,
        ];
        return View::make('logingrupa.biblebuilder::bible.book_chapter_list')->with('data', $data);
    }]);

    // DONE - Generate list of all books of The Bible
    // https://bibele.test/v4/generate/translation/NKJV/books
    Route::get('translation/{db_name}/books', ['as' => 'book_index', function ($db_name){
        $arBibleTranslationsList = array_diff(config('logingrupa.biblebuilder::bible_translation_database_list'), [$db_name]);
        $arBibleSettings = config('logingrupa.biblebuilder::bible_translation_settings');
        $sColumnName = $arBibleSettings[$db_name]['chapter_language_column'];
        $addAcronym = ($arBibleSettings[$db_name]['add_chapter_acronym'] == 'true') ? $db_name.' ' : '';
        $arBibleTranslationLongNameList = [];
        foreach ($arBibleTranslationsList as $key => $arBibleTranslation) {
            DB::purge('sqlite'); 
            Config::set(["database.connections.sqlite.database" => "storage/".$arBibleTranslation.".SQLite3"]);
            $infoTable = DB::table('info')->get()->pluck('value', 'name');
            $arBibleTranslationLongNameList[] = explode (",", $infoTable['description'])[0];
        }
        // dd($arBibleTranslationLongNameList);
        DB::purge('sqlite'); 
        Config::set(["database.connections.sqlite.database" => "storage/".$db_name.".SQLite3"]);
        // DB::reconnect('sqlite');
        // Schema::connection('sqlite')->getConnection()->reconnect();
        $books = DB::table('books')->get();
        $infoTable = DB::table('info')->get()->pluck('value', 'name');
        $bibleTransaltion = explode (",", $infoTable['description']);

        // dd($bibleTransaltion[0]);
        $data = [
            'books' => $books->toArray(),
            'info' => $infoTable,
            'translation' => $db_name,
            'translation_links' => $arBibleTranslationLongNameList,
            'translation_column' => $sColumnName,
            'add_acronym' => $addAcronym,
        ];
        // dd($data);
        return View::make('logingrupa.biblebuilder::bible.book_list')->with('data', $data);
    }]);

    // DONE Page to generate exapmpe array what you can copy and paste in config/config.php file.
    // https://bibele.test/v4/generate/translation/NRT/table_books/short_name
    Route::get('translation/{db_name}/table_books/short_name', ['as' => 'transaltion_short_name', function ($db_name){
        DB::purge('sqlite'); 
        Config::set(["database.connections.sqlite.database" => "storage/".$db_name.".SQLite3"]);
        DB::reconnect('sqlite');
        Schema::connection('sqlite')->getConnection()->reconnect();

        $books = Book::all();
        $infoTable = DB::table('info')->get()->pluck('value', 'name');

        // dd($infoTable);
        $data = [
            'books' => $books->toArray(),
            'info' => $infoTable,
            'translation' => $db_name,
        ];
        return View::make('logingrupa.biblebuilder::bible_book_list_short')->with('data', $data);
    }]);


    // DONE
    // https://bibele.test/v4/generate/table_books/add_short_name_translation_columns
    Route::get('table_books/add_short_name_translation_columns', ['as' => 'add_column_to_each_translation_database', function (){
        $arBibleDatabaseTranslations = config('logingrupa.biblebuilder::bible_translation_database_list');
        $arColumnNames = config('logingrupa.biblebuilder::column_names');
        
        foreach ($arBibleDatabaseTranslations as $arBibleDatabaseTranslation) {
            DB::purge('sqlite');
            Config::set(["database.connections.sqlite.database" => "storage/" . $arBibleDatabaseTranslation . ".SQLite3"]);
            DB::reconnect('sqlite');
            Schema::connection('sqlite')->getConnection()->reconnect();

            $obTable = Schema::connection('sqlite')->getConnection()->getSchemaBuilder();
            echo '<h3>IN DATABASE '.$arBibleDatabaseTranslation . '.SQLite3 </h3>';
            foreach ($arColumnNames as $key => $arColumnName) {
                if ($obTable->hasColumn('books', $arColumnName)) {
                    echo '<b>'.$arColumnName.'</b> already exists in books table.<br>';
                } else {
                    DB::statement("ALTER TABLE books ADD $arColumnName TEXT AFTER short_name;");
                    echo 'Added <b>'.$arColumnName.'</b> to books table in ' . $arBibleDatabaseTranslation . '.SQLite3 database<br>';
                }
            }
        }
    }]);

    Route::get('table_books/add_alternate_short_name', ['as' => 'add_alternate_short_name',function (){
        
        $arBibleDatabaseTranslations = config('logingrupa.biblebuilder::bible_translation_database_list');
        $arColumnNames = config('logingrupa.biblebuilder::column_names');

        foreach ($arBibleDatabaseTranslations as $arBibleDatabaseTranslation) {
            DB::purge('sqlite'); 
            Config::set(["database.connections.sqlite.database" => "storage/" . $arBibleDatabaseTranslation . ".SQLite3"]);
            DB::reconnect('sqlite');
            Schema::connection('sqlite')->getConnection()->reconnect();
            $arBookNumbers = DB::table('books')->get()->pluck('book_number')->toArray();
            $cases = [];
            $ids = [];
            $params = [];
            echo '<h3>TRANSLATION ' . $arBibleDatabaseTranslation . '.SQLite3 database</h3>';
            foreach ($arColumnNames as $key => $arColumnName) {
                echo 'Alternate ' . $arColumnName . ' column values addeed <br>';
                $cases = [];
                $ids = [];
                $params = [];
                $arShortNames = config('logingrupa.biblebuilder::'.$arColumnName);
                foreach ($arShortNames as $id => $arShortName) {
                    $id = $arBookNumbers[$id];
                    $cases[] = "WHEN {$id} then ?";
                    $params[] = $arShortName;
                    $ids[] = $id;
                }

                $ids = implode(',', $ids);
                $cases = implode(' ', $cases);
                if (!empty($ids)) {
                    \DB::update("UPDATE `books` SET `$arColumnName` = CASE `book_number` {$cases} END WHERE `book_number` in ({$ids})", $params);
                }
                echo 'DONE<br>';
            }
        }
    }]);
});

Route::get('v5', function() {
    function transaltion($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }
    $book = Book::find(10);
    // $books = Book::find([50,510]);
    $books = DB::table('books')->get();
    $infoTable = DB::table('info')->get()->pluck('value', 'name');
    $bibleTransaltion = explode (",", $infoTable['description']);
    
    // dd(transaltion($bibleTransaltion[0]));
    $pagePath = 'č';
    $bookChapterResponseBody = Http::get($pagePath)->body();
    $rootFolderName = transaltion($bibleTransaltion[0]); 
    Storage::put( $rootFolderName.'/'. $bibleTransaltion[0] . '.md', htmlspecialchars_decode($bookChapterResponseBody));
    foreach ($books as $key => $book) {
        $bookName = $rootFolderName.'/0' . $key+1 .' '.$book->long_name;
        $chapterName = $book->short_name;
        $onlyChapters = $book->chapters()->where('book_number', '=', $book->book_number)->groupChapters()->get();
        $book_number = $book->book_number;
        $pagePath = 'https://bibele.test/v4/generate/book/'. $book_number;
        
        $bookChapterResponseBody = Http::get($pagePath)->body();
        Storage::put( $bookName . '/'. $book->long_name . '.md', htmlspecialchars_decode($bookChapterResponseBody));
        
        
        foreach ($onlyChapters as $onlyChapter) {
            $responseBody = Http::get($pagePath .'/'. $onlyChapter->chapter )->body();
            
             Storage::put( $bookName . '/' . $chapterName . ' ' . $onlyChapter->chapter .'.md', htmlspecialchars_decode($responseBody));
        }
    }
     return 'Done';
    // $responseBody = Http::get('https://bibele.test/v4/generate/book/10/5')->body();
    // return htmlspecialchars_decode($responseBody);
    // return $responseBody;
});
// Bilbes can be downloaded - https://www.ph4.org/b4_poisk.php
Route::group(['prefix' => 'generate'], function (){
    // Prepear values for generating Bible Book Chapters with verses
    // https://bibele.test/generate/translation/NRT/chapter/10/verses/2/prefix/v
    Route::get('translation/{db_name}/chapter/{book_number}/verses/{chapter}/prefix/{verse_prefix?}', ['as' => 'bible_book_chapter_with_verses', function($db_name, $book_number, $chapter, $verse_prefix='') {
        DB::purge('sqlite');
        Config::set(["database.connections.sqlite.database" => "storage/" . $db_name . ".SQLite3"]);

        $arBook = DB::select(DB::raw("SELECT * FROM books WHERE book_number = $book_number limit 1"));
        $arChapter = DB::select(DB::raw("SELECT * FROM verses WHERE chapter = $chapter limit 1"));
        $chapterCount = DB::table('verses')->where('book_number', '=', $book_number)->groupBy('chapter')->get()->count();
        $arVerses = DB::select(DB::raw("SELECT * from verses where book_number = $book_number and chapter = $chapter"));
        $arInfo = DB::table('info')->get()->pluck('value', 'name');
        $sBibleName = explode (",", $arInfo['description']);
        $bookModel = array_shift($arBook);
        $chapterModel = array_shift($arChapter);

        $currentChapter = $chapter;

        $arBibleTranslationsList = array_diff(config('logingrupa.biblebuilder::bible_translation_database_list'), [$db_name]);
        $arBibleSettings = config('logingrupa.biblebuilder::bible_translation_settings');

        $arTranslations = [];
        foreach ($arBibleTranslationsList as $key => $arBibleTranslation) {
            // dd($arBibleSettings[$arBibleTranslation]);
            $sColumnName = $arBibleSettings[$arBibleTranslation]['chapter_language_column'];
            $addAcronym = ($arBibleSettings[$arBibleTranslation]['add_chapter_acronym'] == 'true') ? $arBibleTranslation.' ' : '';
            // dd($addAcronym);
            $arTranslations[] = $addAcronym . '' .$bookModel->$sColumnName .' ' . $currentChapter;
            // $arBibleTranslationLangs[] = ;
        }
        $sColumnName = $arBibleSettings[$db_name]['chapter_language_column'];
        $addAcronym = ($arBibleSettings[$db_name]['add_chapter_acronym'] == 'true') ? $db_name.' ' : '';

        $prevShort = ($currentChapter == 1) ? $bookModel->long_name :  $addAcronym . $bookModel->$sColumnName . ' ' . $chapter - 1;
        $nextShort = ($currentChapter == $chapterCount) ? $bookModel->long_name : $addAcronym . $bookModel->$sColumnName . ' ' . $chapter + 1;

        $prevLong = ($currentChapter == 1) ? $bookModel->long_name : $bookModel->long_name . ' ' . $chapter - 1;
        $nextLong = ($currentChapter == $chapterCount) ? $bookModel->long_name : $bookModel->long_name . ' ' . $chapter + 1;

        $data = [
            'database' => config('database.connections.sqlite.database'),
            'book' => [
                 'book_number' => $bookModel->book_number,
                 'short_name' => $bookModel->$sColumnName,
                 'long_name' => $bookModel->long_name,
                 'max_chapter' => $chapterCount,
                 'name' => $sBibleName[0],
                 'name_acronym' => $db_name,
                 'translations' => $arTranslations,
             ],
            'chapter' => [
                'long_name' => $bookModel->long_name  .' ' . $currentChapter . '.' .$arInfo['chapter_string'],
                'short_name' => $currentChapter . '.' .$arInfo['chapter_string'],
                'book_name' => $bookModel->long_name,
                'prev_short' => $prevShort,
                'next_short' => $nextShort,
                'prev_long' => $prevLong,
                'next_long' => $nextLong,
                'current_chapter' => $currentChapter,
                'aliases' => $bookModel->long_name . ' ' . $chapter . ', ' . $addAcronym . $bookModel->$sColumnName . ' ' . $chapter,
                'tags' => str_slug($bookModel->$sColumnName . ' ' . $chapter, '-'). ', ' . str_slug($bookModel->short_name_en . ' ' . $chapter, '-'),
             ],
            'verses' => [
                'prefix' => $verse_prefix,
                $arVerses,
                ]
         ];
        //  dd($data);
         return View::make('logingrupa.biblebuilder::bible.chapter_with_verses')->with('data', $data);
    }]);

    Route::get('markdown/{db_name}/{skip?}/{take?}',  function($db_name, $skip=0, $take=90) {
        
        DB::purge('sqlite');
        Config::set(["database.connections.sqlite.database" => "storage/" . $db_name . ".SQLite3"]);

        $books = DB::table('books')->skip($skip)->take($take)->get();
        $infoTable = DB::table('info')->get()->pluck('value', 'name');
        $bibleTransaltionLongName = explode (",", $infoTable['description'])[0];

        $arBibleSettings = config('logingrupa.biblebuilder::bible_translation_settings');

        $sBookIndexPath = route('book_index', ['db_name' => $db_name]);

        // dd($books);
        $bookChapterResponseBody = Http::get($sBookIndexPath)->body();
        $rootFolderName = 'Bible/'.$db_name;
        Storage::put( $rootFolderName.'/'. $bibleTransaltionLongName . '.md', htmlspecialchars_decode($bookChapterResponseBody));
        foreach ($books as $key => $book) {
            
            $bookFolderName = $rootFolderName.'/' . sprintf("%02d", $book->book_number / 10 ) .' '.$book->long_name;
            $sColumnName = $arBibleSettings[$db_name]['chapter_language_column'];
            $addAcronym = ($arBibleSettings[$db_name]['add_chapter_acronym'] == 'true') ? $db_name.' ' : '';
            $chapterName = $addAcronym.$book->$sColumnName;

            $onlyChapters = DB::table('verses')->where('book_number', '=', $book->book_number)->groupBy('chapter')->get();

            $book_number = $book->book_number;
            $sBookChapterIndexPath = route('book_chapter_index', [
                'db_name' => $db_name,
                'id'=> $book_number,
            ]);
            
            $bookChapterResponseBody = Http::get($sBookChapterIndexPath)->body();
            Storage::put( $bookFolderName . '/'. $book->long_name . '.md', htmlspecialchars_decode($bookChapterResponseBody));
            
            
            foreach ($onlyChapters as $onlyChapter) {
                $sBibleBookChapterWithVersesIndexPath = route('bible_book_chapter_with_verses', [
                    'db_name' => $db_name,
                    'book_number'=> $book->book_number,
                    'chapter' => $onlyChapter->chapter,
                    'verse_prefix' => 'v']);
                $responseBody = Http::get($sBibleBookChapterWithVersesIndexPath)->body();

                Storage::put( $bookFolderName . '/' . $chapterName . ' ' . $onlyChapter->chapter .'.md', htmlspecialchars_decode($responseBody));
            }
        }
         return 'Done ' . $db_name . ' Exported';

    });


});

Route::get('/', function() {
    $arBibleDatabaseTranslations = config('logingrupa.biblebuilder::bible_translation_database_list');
        $arColumnNames = config('logingrupa.biblebuilder::column_names');
        echo '<h3>0. Bibles can be downloaded</h3><a href="https://www.ph4.org/b4_poisk.php">Here</a> <br> .SQLite3 files need to be placed in <b>/storage/</b> folder and needs to be defined in <b>plugins/logingrupa/biblebuilder/config/config.php</b> file "bible_translation_database_list" array<br>';
        echo '<h3>0.1 Generate arrays of short_names</h3>';
        foreach ($arBibleDatabaseTranslations as $arBibleDatabaseTranslation) {
            echo 'For <a href="'.route('transaltion_short_name', ['db_name' => $arBibleDatabaseTranslation]).'" target="blank_">'.$arBibleDatabaseTranslation.'</a> TRANSLATION<br>';
        }
        echo 'Bible databases need to be located in <b>/storage/</b> folder with each database needs to be defined in "bible_translation_database_list" array, it can be found in <b>plugins/logingrupa/biblebuilder/config/config.php</b><br>
        example <b>NLT.SQLite3</b> will be definded in array as <b>NLT</b>';
        echo '<h3>1. Generate translation columns for all databases</h3>';
        foreach ($arColumnNames as $arColumnName) {
            echo $arColumnName.'<br>';
        }
        echo 'Translation columns can be defined in <b>plugins/logingrupa/biblebuilder/config/config.php</b><br>';
        echo '<a href="'. route('add_column_to_each_translation_database').'" target="blank_">Generate columns in all Databases</a><br>';
        
        
        echo '<h3>2. Generate short_names_?? tables for all translations and databases</h3>';
        echo '<a href="'. route('add_alternate_short_name').'" target="blank_">Generate values in all Databases</a><br>';
        
        echo '<h3>3. Preview Bible chapter with verses</h3>';
        foreach ($arBibleDatabaseTranslations as $arBibleDatabaseTranslation) {
            echo 'For <a href="'.route('bible_book_chapter_with_verses', [
                'db_name' => $arBibleDatabaseTranslation, 'book_number'=> 10, 'chapter' => 1, 'verse_prefix' => 'v']).'" target="blank_">'.$arBibleDatabaseTranslation.'</a> TRANSLATION<br>';
        }
});


