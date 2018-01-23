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
    static public function index()
    {
        $posts = DB::table('posts')->get();

        return view('home', ['posts' => $posts]);
    }

    static public function articlePoster($user_id) {
        $poster = DB::table('users')->where('id', $user_id)->first()->name;

        return $poster;
    }

    static public function countVotes($post_id) {
        $upVotes =        DB::table('votes')->where('post_id', $post_id)->where('vote',  1)->count();
        $downVotes =    DB::table('votes')->where('post_id', $post_id)->where('vote', -1)->count();

        $points = $upVotes - $downVotes;

        if ($points === 1 || $points === -1) {
            $points .= ' point';
        }
        else {
            $points .= ' points';
        }

        return $points;

    }

    static public function countComments($post_id) {
        $comments = DB::table('comments');
        $count = $comments->where('post_id', "$post_id")->count();

        if ($count === 1) {
            $count .= ' comment';
        }
        else {
            $count .= ' comments';
        }

        return $count;
    }
}