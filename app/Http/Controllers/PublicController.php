<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    CONST TEMPLATE = 'template_default';

    public function index() {
        return view(self::templateView('layout'));
    }

    public static function templateView(string $view)
    {
        return self::TEMPLATE . '/' . $view;
    }
}
