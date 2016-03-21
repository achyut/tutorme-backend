<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of categories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		return $categories;
	}

	/**
	 * Store a newly created category in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Category::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		Category::create($data);
		return $this->getSuccessResponse($data,"Category Successfully created!");
	}

	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Category::find($id);
		if(!$category){
			return $this->getFailResponse("Unable to find category with id ".$id);
		}
		return $category;
	}

	/**
	 * Update the specified category in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Category::find($id);
		if(!$category){
			return $this->getFailResponse("Unable to find category with id ".$id);
		}
		$validator = Validator::make($data = Input::all(), Category::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		$category->update($data);

		return $this->show($id);
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		if(!$category){
			return $this->getFailResponse("Unable to find category with id ".$id);
		}
		Category::destroy($id);
		return $this->index();
	}

	public function getsubcategories($id)
	{
		$category = Category::find($id);
		if(!$category){
			return $this->getFailResponse("Unable to find category with id ".$id);
		}
		$subcategories = $category->subcategory;
		return $subcategories;
	}

	public function getAllCategories(){
		$categories = Category::all();
		foreach ($categories as $cat) {
			$cat['subcategories'] = $cat->subcategory;
		}
		$data['result'] = $categories;
		return $data;
	}
}
