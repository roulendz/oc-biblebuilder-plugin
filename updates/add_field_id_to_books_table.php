<?php namespace Logingrupa\BibleBuilder\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use DB;
/**
 * Class CreateTableBooks
 * @package Logingrupa\BibleBuilder\Classes\Console
 */
class AddFieldIdToBooksTable extends Migration
{
    const TABLE = 'books';
    const COLUMN = 'id';

    /**
     * Apply migration
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $obTable)
        {
            DB::statement("ALTER TABLE books RENAME TO old_books;");
            DB::statement("CREATE TABLE books (
                book_color TEXT	YES	NULL,
                book_number	NUMERIC	YES	NULL,
                short_name TEXT YES	NULL,
                long_name TEXT YES	NULL,
                active boolean not null default 1
            );");
            DB::statement("INSERT INTO books (book_color, book_number, short_name, long_name) SELECT * FROM old_books;");
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
