<?php

class Review extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'rating' => 'required',
		 'review' => 'required',
		 'post' => 'required',
		 'created_by' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['rating','review','post','created_by'];


	public function getPost(){
		return $this->belongsTo('Post','post');
	}

}