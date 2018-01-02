<?php

namespace App\Http\Controllers;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addArticle');
    }

    public function postArticle()
    {
        return view('addArticle');
    }
}
