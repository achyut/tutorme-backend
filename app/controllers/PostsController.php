<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		return $posts;
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data = Input::all();
		Log::info($data);

		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		Post::create($data);

		return $this->index();
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		if(!$post){
			return $this->getFailResponse("Unable to find post with id ".$id);
		}
		return $post;
	}


	/**
	 * Update the specified post in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::find($id);
		if(!$post){
			return $this->getFailResponse("Unable to find post with id ".$id);
		}

		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		$result = $post->update($data);
		return $this->show($id);
	}

	/**
	 * Remove the specified post from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		if(!$post){
			return $this->getFailResponse("Unable to find post with id ".$id);
		}
		Post::destroy($id);
		return $this->index();
	}

}
