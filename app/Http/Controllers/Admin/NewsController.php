<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function  add ()
    {
        var_dump('test');
        exit;
        return view ('admin.news.create');
        
    }
}
