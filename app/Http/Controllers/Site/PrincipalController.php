<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class PrincipalController extends Controller
{
    public function principal()
    {
        return view("site.principal", ['titulo'=>'Principal']);
    }
}
