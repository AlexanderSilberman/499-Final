<?php

class UserController extends BaseController{
	
    public function MakeLogin(){
	  if (Auth::check())
	  {
		  return Redirect::to('ultrared')
		  ->with('success', 'You are already logged in!');
	  }
	  return View::make('manga/login');
	}
   
 
  public function CreateAccount(){
	$validation=User::validate(Input::all());

    if($validation->passes()){
		$user=new user();
		$user->username=Input::get('username');
		$user->password=Hash::make(Input::get('password'));
		$user->save();
		
		if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))){

       
        	return Redirect::to('naruto')
            ->with('success', 'Congrats, welcome to the site!');
		}
    }

    return Redirect::to('login')
        ->withInput()
        ->with('errors', $validation->messages());
   }



	public function MakeSignin(){
		if (Auth::check()){
			return Redirect::to('naruto')
			->with('success', 'You are already logged in');
		}
		return View::make('manga/signin');	
	}	
	
	
	public function SignIn(){
		$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
	  if (Auth::attempt(($userdata), true)) {

    	return Redirect::to('naruto');
	  }
	  else{
		  return Redirect::to('signin')
		  ->with('error', 'Invalid Username or Password');
	}
	
	return Redirect::to('naruto')
            ->with('success', 'Your insertion was completed successfully!');
	
		
	}
	
	public function LogOut(){
		Auth::logout();
		return Redirect::to('naruto')
		->with('success', 'You have been logged out');
	}
}