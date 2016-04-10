<?php

class ReviewsController extends \BaseController {

	/**
	 * Display a listing of reviews
	 *
	 * @return Response
	 */
	public function index()
	{
		$reviews = Review::all();

		return $reviews;
	}

	/**
	 * Store a newly created review in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Review::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		Review::create($data);
		return $this->getSuccessResponse($data,"Review Successfully created!");
	}

	/**
	 * Display the specified review.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$review = Review::find($id);
		if(!$review){
			return $this->getFailResponse("Unable to find review with id ".$id);
		}
		return $review;
	}

	/**
	 * Update the specified review in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$review = Review::find($id);
		if(!$review){
			return $this->getFailResponse("Unable to find review with id ".$id);
		}
		$validator = Validator::make($data = Input::all(), Review::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		$review->update($data);

		return $this->show($id);
	}

	/**
	 * Remove the specified review from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$review = Review::find($id);
		if(!$review){
			return $this->getFailResponse("Unable to find review with id ".$id);
		}
		Review::destroy($id);
		return $this->index();
	}

	public function getPost($id)
	{
		$review = Review::find($id);
		if(!$review){
			return $this->getFailResponse("Unable to find review with id ".$id);
		}
		$post = $review->getPost;
		return $post;
	}
}
