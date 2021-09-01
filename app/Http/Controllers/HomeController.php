<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Repositories\PostRepository;

class HomeController extends Controller
{
    /**
     * ポストリポジトリ
     * 
     * @var PostRepository
     * 
     */
    protected $posts;

    
    /**
     * Create a new controller instance.コンストラクタ
     *
     * @return void
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');

        $this->posts = $posts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       // $posts= Post::orderBy('created_at', 'desc')->get();
       //$user = auth()->user();
    
        //return view('home' , compact('posts','user'));
        return view('home' ,[
            'posts'=> $this->posts->forUser($request->user()),
        
        ] );
    }
}
