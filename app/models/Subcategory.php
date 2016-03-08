<?php

class Subcategory extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required',
		'category' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','category'];

}