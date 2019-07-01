<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth')->except([]);
    }

    public function showPanel()
    {

        return view('panels.user-panel');
    }
}
