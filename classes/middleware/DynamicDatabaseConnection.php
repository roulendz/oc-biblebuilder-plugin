<?php namespace Logingrupa\BibleBuilder\Classes\Middleware;

use DB;
use Config;
use Schema;
use Closure;
 
class DynamicDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        DB::purge('sqlite'); 
        Config::set(["database.connections.sqlite.database" => "storage/" .$request->route('db_name'). ".SQLite3"]);
        DB::reconnect('sqlite');
        Schema::connection('sqlite')->getConnection()->reconnect();

        return $next($request);
    }
}

