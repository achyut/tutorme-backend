<?php

class SubcategoriesController extends \BaseController {

	/**
	 * Display a listing of subcategories
	 *
	 * @return Response
	 */
	public function index()
	{
		$subcategories = Subcategory::all();

		return $subcategories;
	}


	/**
	 * Store a newly created subcategory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Subcategory::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		Subcategory::create($data);

		return $this->getSuccessResponse($data,"SubCategory Successfully created!");
	}

	/**
	 * Display the specified subcategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subcategory = Subcategory::find($id);
		if(!$subcategory){
			return $this->getFailResponse("Unable to find subcategory with id ".$id);
		}
		return $subcategory;
	}

	/**
	 * Update the specified subcategory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$subcategory = Subcategory::find($id);
		if(!$subcategory){
			return $this->getFailResponse("Unable to find subcategory with id ".$id);
		}
		$validator = Validator::make($data = Input::all(), Subcategory::$rules);

		if ($validator->fails())
		{
			return $this->getFailValidationResponse($validator);
		}

		$subcategory->update($data);

		return $this->show($id);
	}

	/**
	 * Remove the specified subcategory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$subcategory = Subcategory::find($id);
		if(!$subcategory){
			return $this->getFailResponse("Unable to find subcategory with id ".$id);
		}
		Subcategory::destroy($id);

		return $this->index();
	}

}
