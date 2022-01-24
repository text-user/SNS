<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Arr;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = \Request::query();
        if(isset($q['category_id'])){
            $posts = Post::latest()->where('category_id', $q['category_id'])->get();
            $posts->load('categories', 'user');

            return view('posts.index', [
                'posts' => $posts,
            ]);
        } else {
            $posts = Post::latest()->get();
            $posts->load('categories', 'user');

            return view('posts.index', [
                'posts' => $posts,
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        if($request->file('image')->isvalid()) {
            $post = new Post;
            // $input = $request->only($post->getFillable());
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;
            $post->content = $request->content;
            $post->title = $request->title;

            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);

            // if(!isset($input['image'])){
            //     Arr::set($input, 'image', basename($filename));
            // }
            // dd($input);

            // $post = $post->create($input);

            // preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);
            // dd($match);

            $post->save();
        }
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('categories', 'user', 'comments.user');
        return view('posts.show', [
            'post' =>$post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->search}%")
        ->orWhere('content', 'like',  "{%$request->search}%")
        ->get();
        
        $search_result = $request->search. '検索結果'.count($posts).'件です';


        return view('posts.index', [
            'posts' => $posts,
            'search_result' => $search_result
        ]);
    }


}

