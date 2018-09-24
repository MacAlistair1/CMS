<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'blog_image' => 'image|nullable|max:1999'
        ]);

       if($request->hasFile('blog_image')){
		   $blog_image = $request->file('blog_image');
		   $blog_image_ext = $blog_image->getClientOriginalExtension();
		   $new_image_name = rand(123456,999999).".".$blog_image_ext;
		   $destination_path = public_path('/img');
		   $blog_image->move($destination_path, $new_image_name);
		   
	   }else{
		   return redirect('/posts')->with('error', 'Choose an image File!');
	   }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->blog_image = $new_image_name;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'blog_image' => 'image|nullable|max:1999'
        ]);
        
		if($request->hasFile('blog_image')){
		   $blog_image = $request->file('blog_image');
		   $blog_image_ext = $blog_image->getClientOriginalExtension();
		   $new_image_name = rand(123456,999999).".".$blog_image_ext;
		   $destination_path = public_path('/img');
		   $blog_image->move($destination_path, $new_image_name);
		   
	   }else{
		   return redirect('/posts')->with('error', 'Choose an image File!');
	   }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->blog_image = $new_image_name;
        $post->save();

        return redirect('/posts')->with('success','Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', "Unauthorized Page!");
        }

        if($post->blog_image != 'noname.jpg'){
            // Del Image
            Storage::delete('public/blog_images/'.$post->blog_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted!');
    }
}
