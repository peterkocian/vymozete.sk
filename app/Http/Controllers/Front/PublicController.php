<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    CONST TEMPLATE = 'front';

    public function index() {
        return view(self::templateView('main'));
    }

    public function home() {
        return view(self::templateView('home'));
    }

    public function vop() {
        return view(self::templateView('vop'));
    }

    public static function templateView(string $view)
    {
        return self::TEMPLATE . '/' . $view;
    }
}
