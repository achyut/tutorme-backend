<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return $users;
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}
		$data['password'] = Hash::make($data['password']);
		$result = User::create($data);
		$message = "User successfully registered. Please login to continue.";
		return $this->getSuccessResponse($result,$message);
		
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		return $user;
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}

		$validator = Validator::make($data = Input::all(), User::$rules_update);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}
		if(Input::has('password')){
			$data['password'] = Hash::make($data['password']);	
		}
		
		$user->update($data);

		return $this->show($id);
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		User::destroy($id);

		return $this->index();
	}

	public function login(){
		 $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
		$result = User::checkLogin($userdata['email'],$userdata['password']);
		if($result){
			return $this->getSuccessResponse($result,"Valid login credentials");
		}
		else{
			return $this->invalidLoginResponse();
		}
	}



	public function storeCategoriesOfUser($id){
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		if(!Input::has('categories')){
			return $this->getFailResponse("You should have list of category ids");	
		}
		$categories = Input::get('categories');
		$result = $user->storeCategories($categories);		
		if($result){
			return $this->getSuccessResponse($result,"All categories of user");
		}
		else{
			return $this->getFailResponse("Unable to store categories for user with id ".$id);
		}
	}

	public function storeSubCategoriesOfUser($id){
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		if(!Input::has('subcategories')){
			return $this->getFailResponse("You should have list of subcategory ids");	
		}
		$subcategories = Input::get('subcategories');
		$result = $user->storeSubCategories($subcategories);		
		if($result){
			return $this->getSuccessResponse($result,"All subcategories of user");
		}
		else{
			return $this->getFailResponse("Unable to store subcategories for user with id ".$id);
		}
	}

	public function storePost($id)
	{
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		$data = Input::all();
		$data['created_by'] = $id;	
		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}
		
		Post::create($data);
		return $this->getAllPost($id);
	}

	public function getAllPost($id)
	{
		Log::info("Calling post");
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		$posts = $user->post;
		$result['result'] = $posts;
		return $result;
	}

	public function getAllCategoriesOfUser($id){
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		$categories = $user->category;
		return $categories;
	}

	public function getAllSubCategoriesOfUser($id){
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
		$subcategories = $user->subcategory;
		return $subcategories;
	}

}

