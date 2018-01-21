<?php
/**
 * Created by PhpStorm.
 * User: Joren
 * Date: 27/12/2017
 * Time: 14:48
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CheckVoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($vote)
    {
        $tinyVote = NULL;
        switch ($vote) {
            case 'up':
                $tinyVote = 1;
                break;
            case 'down':
                $tinyVote = -1;
                break;
            default:
                $tinyVote = 0;
                break;
        }

        if (isset($_POST['article_id']) && $vote !== 0) {
            $postId = $_POST['article_id'];
            $post = DB::table('posts')
                        ->where('id', $postId)
                        ->value('id');
            if ($post>0) {
                $userId = Auth::id();
                $votes = DB::table('votes');
                $userVote = $votes->where('post_id', $postId)->where('user_id', $userId);
                $hasVoted = $userVote->count();
                if ($hasVoted) {
                    $userVote->update(['vote' => $tinyVote]);
                }
                else {
                    $votes->insert(['vote' => $tinyVote, 'user_id' => $userId, 'post_id' => $postId]);
                }
            }
        }
        return redirect('/home');
    }

    static public function CheckVote($article_id, $type) {
        $userId = Auth::id();
        $vote = DB::table('votes')->where('post_id', $article_id)->where('user_id', $userId)->value('vote');

        if ($vote === $type)  { $return = true; }
                                else { $return = false; }

        return $return;
    }
}