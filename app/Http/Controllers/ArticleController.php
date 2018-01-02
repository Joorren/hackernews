<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
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
    public function index()
    {
        return view('addArticle');
    }

    public function editIndex($article_id) {
        $article = DB::table('posts')->where('id', $article_id)->first();
        return view('editArticle', ['article' => $article]);
    }

    public function postArticle()
    {
        $return = view('addArticle');
        $errors = [];
        if (isset($_POST['title']) && isset($_POST['url'])) {
            $title=$_POST['title'];
            $url=$_POST['url'];
            if ($title === "") {
                array_push($errors, 'The title field is required.');
            }
            if (strlen($title) > 255) {
                array_push($errors, 'The title may not be greater than 255 characters.');
            }
            if ($url === "") {
                array_push($errors, 'The url field is required.');
            }
            elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
                array_push($errors, 'The url format is invalid.');
            }
        }
        else {
            array_push($errors, 'Attributes didn\'t get posted.');
        }

        if (count($errors) > 0) {
            $errors = collect($errors);
            session(['error'=>$errors]);
        }
        else {
            DB::table('posts')->insert([
                'name' => $title,
                'url' => $url,
                'user_id' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            session(['success'=>"Article '$title' created succesfully."]);
            $return = PostController::index();
        }
        return $return;
    }

    public function editArticle() {
        $return = redirect('/');
        $errors = [];
        if (isset($_POST) && $_POST) {
            if (isset($_POST['id']) && $_POST['id'] !== "") {
                $article_id = $_POST['id'];
                $return = $this->editIndex($article_id);
                if (isset($_POST['title']) && isset($_POST['url'])) {
                    $title = $_POST['title'];
                    $url = $_POST['url'];
                    if ($title === "") {
                        array_push($errors, 'The title field is required.');
                    }
                    if (strlen($title) > 255) {
                        array_push($errors, 'The title may not be greater than 255 characters.');
                    }
                    if ($url === "") {
                        array_push($errors, 'The url field is required.');
                    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
                        array_push($errors, 'The url format is invalid.');
                    }
                } else {
                    array_push($errors, 'Attributes didn\'t get posted.');
                }
            }
            else {
                $return = redirect('/');
            }

            if (count($errors) > 0) {
                $errors = collect($errors);
                session(['error'=>$errors]);
            }
            else {
                $article = DB::table('posts')->where('id', $article_id)->first();
                if ($article->user_id === Auth::id()) {
                    DB::table('posts')->where('id', $article_id)->update([
                        'name' => $title,
                        'url' => $url,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
                session(['success' => "Article '$title' editted succesfully."]);
                $return = PostController::index();
            }
        }
        return $return;
    }
}
