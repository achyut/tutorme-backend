<?php

class Post extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required',
		 'shortdesc' => 'required',
		 'price' => 'required',
		 'startdate' => 'required',
		 'enddate' => 'required',
		 'preferedcontact' => 'required',
		 'created_by' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['title','shortdesc','longdesc','price','rating','startdate','enddate','starttime','endtime','address','contact','email','preferedcontact','created_by'];

}