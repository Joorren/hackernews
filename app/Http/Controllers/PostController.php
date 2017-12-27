<?php
/**
 * Created by PhpStorm.
 * User: Joren
 * Date: 27/12/2017
 * Time: 0:58
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
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
    {$posts = DB::table('posts')->get();

        return view('home', ['posts' => $posts]);
    }
}