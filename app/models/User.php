<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password','remember_token');

	public static $rules = [
		'name' => 'required',
		'password' => 'required',
		'usertype' => 'required',
		'email' => 'required|email|unique:users'
	];

	public static $rules_update = [
		'name' => 'required',
		'usertype' => 'required',
		'email' => 'required|email'
	];

	protected $fillable = array('name', 'password','address','contact','email','usertype');

	public static function checkLogin($email,$password){
		//$password = Hash::make($password);
		$usr = User::where('email','=',$email)->get()->first();
		if(Hash::check($password,$usr->password)){
			return $usr;
		}
		return false;
	}

	public function category()
    {
        return $this->belongsToMany('Category','category_user','user_id','category_id');
    }

    public function Subcategory()
    {
    	return $this->belongsToMany('Subcategory','subcategory_user','user_id','subcategory_id');
    }

    public function post(){
    	return $this->hasMany('Post','created_by');
    }
   
	public function storeCategories($categories){
		$result = $this->category()->sync($categories);
		return $result;
	}

	public function storeSubCategories($subcategories){
		$result = $this->Subcategory()->sync($subcategories);
		return $result;
	}
}
