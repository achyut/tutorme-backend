<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('sponsorprice','desc')->get();
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
		$data = Input::all();
		
		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		$result = $post->update($data);
		return $this->getSuccessResponse($post,"Post Successfully updated!");
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

	public function getReviews($id){
		$post = Post::find($id);
		if(!$post){
			return $this->getFailResponse("Unable to find post with id ".$id);
		}
		$reviews = $post->review;
		$result['result'] = $reviews;
		return $result;
	}

	public function sponsor($id)
	{
		$post = Post::find($id);
		if(!$post){
			return $this->getFailResponse("Unable to find post with id ".$id);
		}

		$validator = Validator::make($data = Input::all(), Post::$sponserrules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}
		if($data['sponsorprice']<=0){
			$data['sponsored'] = 0;	
			$data['sponsorprice'] = 0;
		}
		else{
			$data['sponsored'] = 1;	
		}
		$result = $post->update($data);
		$post = $this->show($id); 
		return $this->getSuccessResponse($post,"Post Successfully sponsored!!");
	}

	public function search(){
		
		//Log::info(Input::all());
        $keyword = Input::get("keyword");
        $rating = Input::get("rating");
        $category = Input::get("category");
        $subcategory = Input::get("subcategory");
		$pricefrom = Input::get("price-from");
		$priceto = Input::get("price-to");
		
		$query = "";
		$and = false;
		if(!empty($keyword)) {
			$words = preg_split('/\s+/', $keyword);
			foreach($words as $word) {
			    $word = trim($word);
			    if(!empty($word)){
					$query = $query ." title LIKE '%".$word."%' or ";    	
			    }
			}
			$query = substr($query,0,-3);
			$and = true;
		}
		if(!empty($category)){
			if($and){
				$query = $query ." and ";	
			}
			$and = true;
			$query = $query ." category ='".$category."' ";
		}
		if(!empty($rating)){
			if($and){
				$query = $query ." and ";	
			}
			$and = true;
			$query = $query ." rating ='".$rating."' ";
		}
		if(!empty($subcategory)){
			if($and){
				$query = $query ." and ";	
			}
			$and = true;
			$query = $query ." subcategory='".$subcategory."' ";
		}

		if(!empty($pricefrom) && empty($priceto)){
			if($and){
				$query = $query ." and ";	
			}
			$and = true;
			$query = $query ." price >='".$pricefrom."' ";
		}
		if(!empty($priceto) && empty($pricefrom)){
			if($and){
				$query = $query ." and ";	
			}
			$and = true;
			$query = $query ." price <='".$priceto."' ";
		}
		if(!empty($priceto) && !empty($pricefrom)){
			if($and){
				$query = $query ." and ";	
			}
			$query = $query ." price between ".$pricefrom." and ".$priceto." ";
			$and = true;
		}
		if($and){
			$query = $query ."  order by sponsorprice desc";
			//dd($query);
			$posts = Post::whereRaw($query)->get();	
		}
		else{
			$posts = Post::orderBy('sponsorprice','desc')->get();
		}
		
		$result['result'] = $posts;
		return $result;

	}

}
