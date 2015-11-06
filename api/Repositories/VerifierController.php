<?php

namespace Api\Repositories;

use App\User;
use Validator;
use Request;
use Auth;
use Dingo\Api\Exception\StoreResourceFailedException;
use Api\Controller;

class VerifierController extends Controller
{

 	public function verify($username, $password)
	    {
	    	$rules = [
	    			'name' => ['required', 'alpha'],
	    			'password' => ['required', 'min:6']
	    	];
	    	
	    	$credentials = [
	    			'name'    => $username,
	    			'password' 	  => $password,
	    	];
	    	
	    	$validator = Validator::make($credentials, $rules);

	    	if ($validator->fails()) {
	    		throw new StoreResourceFailedException('用户登录失败.', $validator->errors());
	    	}
	    
	    	if (Auth::once($credentials))
	    	{
	    		return Auth::user()->id;
	    	}
	  	  	return false;
	    }
}