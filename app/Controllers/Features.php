<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;

class Features extends Controller
{
    function index()
    {
        $this->view->forge('features/index');
    }
}
