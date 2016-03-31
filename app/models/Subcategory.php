<?php

class Subcategory extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required|unique:subcategories',
		'category' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','category'];

}