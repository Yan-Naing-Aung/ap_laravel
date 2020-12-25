<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\storedPost;
use App\Models\Category;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\storePostRequest;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mail::raw('Hello World',function($msg){
        //     $msg->to('yannaingaung@gmail.com')->subject('AP Index Function');
        // });
        $posts = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        //$request->session()->flash('status','Task was successful');
        return view('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated + ['user_id' => Auth::user()->id]);
        //Mail::to('yannaingaung@gmail.com')->send(new storedPost($post));

        return redirect('/posts')->with('status',config('aprogrammer.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post->category->name);   // model relationship

        //** Authorization **/
        // if($post->user_id != auth()->id())  //limiting access manual
        // {
        //     abort(403);
        // }

        //$this->authorize('view',$post);   // using postpolicy  

        // if (! Gate::allows('allow-access', $post)) {   // using gate allow
        //     abort(403);
        // }
        
        Gate::authorize('allow-access', $post);  // using gate authorize
        return view('view',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Post $post)
    {
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();
        
        $validated = $request->validated();
        $post->update($validated);
        Mail::to('yannaingaung@gmail.com')->send(new PostCreated());
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
}
