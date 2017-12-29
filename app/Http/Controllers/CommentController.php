<?php
/**
 * Created by PhpStorm.
 * User: Joren
 * Date: 29/12/2017
 * Time: 12:48
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
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
    public function index($article_id)
    {
        $post = DB::table('posts')->where('id', $article_id)->first();
        $comments = DB::table('comments')->where('post_id', $article_id)->get();
        return view('comments', ['post' => $post, 'comments' => $comments]);
    }

    public function addComment() {

    }
}