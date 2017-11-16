<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function show_film()
    {
        return view('films');
    }

    public function show_submission()
    {
        return view('submission');
    }

    public function distribution()
    {
        return view('distribution');
    }

    public function how_this_work()
    {
        $films = DB::table('videos')->get();
        return view('how_this_work',['films' => $films]);
    }
}
