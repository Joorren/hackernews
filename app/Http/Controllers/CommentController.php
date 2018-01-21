<?php
/**
 * Created by PhpStorm.
 * User: Joren
 * Date: 29/12/2017
 * Time: 12:48
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;


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

    public function editIndex($comment_id) {
        $comment = DB::table('comments')->where('id', $comment_id)->first();
        return view('editComment', ['comment' => $comment]);
    }

    public function addComment() {
        $returnPath='/comments';
        if (isset($_POST) && $_POST) {
            $comment = htmlentities($_POST['body']);
            $returnPath .= '/'.$_POST['article_id'];

            DB::table('comments')->insert([
                'content' => $comment,
                'user_id' => Auth::id(),
                'post_id' =>  $_POST['article_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            session(['success' => "Comment added succesfully."]);
        }

        return redirect($returnPath);
    }

    public function editComment() {
        $return = redirect('/');
        if (isset($_POST) && $_POST) {
            $comment_id = $_POST['comment_id'];
            $content = $_POST['body'];
            $comment = DB::table('comments')->where('id', $comment_id)->first();
            $post = $comment->post_id;
            if ($comment->user_id === Auth::id()) {
                DB::table('comments')->where('id', $comment_id)->update([
                    'content' => $content,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                session(['success' => "Comment edited succesfully."]);
                $return = redirect("comments/edit/$comment_id");
            }
        }
        return $return;
    }

    public function deleteComment($comment_id) {
        $return = redirect("/");
        if (isset(Auth::user()->id)) {
            $comment = DB::table('comments')->where('id', $comment_id)->get();
            if (count($comment)) {
                $post = $comment[0]->post_id;
                if ($comment[0]->user_id === Auth::id()) {
                    DB::table('comments')->where('id', $comment_id)->delete();
                }
                $return = redirect("comments/$post");
            }
        }
        return $return;
    }
}