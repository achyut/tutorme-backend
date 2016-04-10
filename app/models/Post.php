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
	public static $sponserrules = [
		 'sponsorprice' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title','shortdesc','longdesc','price','rating','sponsored','sponsorprice','startdate','enddate','starttime','endtime','address','contact','email','preferedcontact','created_by','category','subcategory'];


	public function getcategory(){
		return $this->belongsTo('Category','category');
	}

	public function getsubcategory(){
		return $this->belongsTo('Subcategory','subcategory');
	}

	public function review(){
    	return $this->hasMany('Review','post')->orderBy('rating','desc');
    }
}