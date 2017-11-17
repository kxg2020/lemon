<?php
namespace App\Listeners;
/**
 * Created by PhpStorm.
 * User: wei gao
 * Email:1225039937@qq.com
 * Date: 2017/11/17
 * Time: 10:04
 */
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryListener
{
    public function __construct()
    {

    }

    public function handle(QueryExecuted $executed)
    {
        $sql = str_replace("?", "'%s'", $executed->sql);

        $log = vsprintf($sql, $executed->bindings);

        Log::info($log);
    }
}