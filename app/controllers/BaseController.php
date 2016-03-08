<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function getFailValidationResponse($validation){
		$mess = "";
		$messages = $validation->messages();
		foreach ($messages->all() as $message)
		{
		    $mess .= $message; 
		}
		$output = array('error' => true, 
			'message' => $mess
		);
		return  Response::json($output,400);
	}

	public function checkIfUserExists($id){
		$user = User::find($id);
		if(!$user){
			return $this->getFailResponse("Unable to find user with id ".$id);
		}
	}
	public function getFailResponse($message){
		$output = array('error' => true, 
			'message' => $message
		);
		return  Response::json($output,400);
	}
	public function getSuccessResponse($data,$message){
		$data['message'] = $message;
		$data['error'] = false;
		return $data;
	}

	public function invalidLoginResponse(){

		$output = array('error' => true, 
			'message' => "Invalid login credentials"
		);
		return  Response::json($output,401);

	}

}
