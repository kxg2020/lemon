<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaController extends Controller
{
    //
    public function index()
    {
        return response()->json(array(
           'user' => 'admin',
        ));
    }
}
