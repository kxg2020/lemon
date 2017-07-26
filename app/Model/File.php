<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    //
    public function scopeOfDir($query, $dir)
    {
        if(!empty($dir)){
            return $query->where('dir', $dir);
        }
        return $query;
    }

    public function getDirs(){
        return DB::table('files')->select('dir')->groupBy('dir')->get();
    }

}
