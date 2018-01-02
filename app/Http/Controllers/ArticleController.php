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
}
