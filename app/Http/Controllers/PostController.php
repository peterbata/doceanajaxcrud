<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$post = Post::paginate(4);
		return view('post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPost(Request $request)
    {
        $rules = array(
			'title' => 'required',
			'body' => 'required',
		);
		$validator = Validator::make (Input::all(), $rules);
		if ($validator->fails())
		return Response::json(array('errors' => $validator->getMessageBag()->toarray()));

		else {
			$post = new Post;
			$post->title = $request->title;
			$post->body = $request->body;
			$post->save();
			return response()->json($post);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPost(request $request)
    {
        $post = Post::find ($request->id);
		$post->title = $request->title;
		$post->body = $request->body;
		$post->save();
		
  	return response()->json($post);
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
    public function deletePost(request $request)
    {
    $post = Post::find ($request->id)->delete();
  	return response()->json();
    }
}