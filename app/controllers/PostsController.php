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

		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		Post::create($data);
		return $this->getSuccessResponse($data,"Post Successfully created!");
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
		$post['category'] = $post->getcategory;
		$post['subcategory'] = $post->getsubcategory;
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
		return $this->getSuccessResponse($post,"Post Successfully deleted!");
	}

}
