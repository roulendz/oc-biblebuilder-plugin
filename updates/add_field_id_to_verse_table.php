<?php namespace Logingrupa\BibleBuilder\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use DB;
/**
 * Class CreateTableBooks
 * @package Logingrupa\BibleBuilder\Classes\Console
 */
class AddFieldIdToVerseTable extends Migration
{
    const TABLE = 'verses';
    const COLUMN = 'id';
    const PREFIX = 'BJT';

    /**
     * Apply migration
     */
    public function up()
    {
        // if (Schema::hasColumn(self::TABLE, self::COLUMN)) {
        //     return;
        // }

        // Schema::table(self::TABLE, function (Blueprint $obTable)
        // {
        //     $obTable->integer('id')->nullable()->before('book_number');
        // });

        

        Schema::table(self::TABLE, function (Blueprint $obTable)
        {
            DB::statement("ALTER TABLE verses RENAME TO old_verses;");
            DB::statement("CREATE TABLE verses (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                book_number NUMERIC(10, 0) DEFAULT NULL,
                chapter NUMERIC(10, 0) DEFAULT NULL,
                verse NUMERIC(10, 0) DEFAULT NULL,
                text CLOB DEFAULT NULL COLLATE BINARY
            );");
            DB::statement("INSERT INTO verses (book_number, chapter, verse, text) SELECT * FROM old_verses;");
            DB::statement("INSERT INTO info (name, value) VALUES
            (prefix, self::PREFIX);");
            DB::statement("UPDATE verses
                SET text = REPLACE(text, 'J>', 'b>')
                WHERE text like '%J>%';");
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (Schema::hasColumn(self::TABLE, self::COLUMN)) {
            Schema::table(self::TABLE, function($obTable) {
                // $obTable->dropColumn('id');
            });
        }
    }
        
}
