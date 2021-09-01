<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;



class PostController extends Controller
{
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Post::create($request->all());

        $inputs=$request->validate ([
            'title' => 'required|max:255',
            'body'=> 'required|max:255',
            'image'=> 'image|max:1024',

        ]);

        $post = new post();
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->user_id = auth()->user()->id;

        if(request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_'.  $original;
            $file = request()->file('image')->move('storage/images' , $name);
            $post->image = $name;
        }

        $post->save();
        return back()->with('message' , '投稿を保存しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('post.destroy', $post);
        $post->delete;
        return redirect()->route('home')->with('message' , '投稿を削除しました');
    }
}
