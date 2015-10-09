<?php

namespace view;

class RegisterView {

	private static $username = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $Register = 'RegisterView::Register';
	private static $messageId = 'RegisterView::Message';
	private $message='';
    
    

    public function validation(){

        $validationError='';

        

        if(strlen(trim($this->getRequestUserName())) < 3)
		{
            
				$validationError .= 'Username has too few characters, at least 3 characters.<br />';
				
		}
		if(strlen(trim($this->getRequestPassword())) < 6)
		{
                $validationError .=  'Password has too few characters, at least 6 characters.<br />';

		}
	    if(trim($this->getRequestPassword())!== trim($this->getRequestPasswordRepeat()))
		{
				$validationError .=  'Passwords do not match.';
		}

		if ($this->getRequestUserName() != strip_tags($this->getRequestUserName()))
		{    
           $validationError .= "Username contains invalid characters.<br>"; 
           $_POST[self::$username] = strip_tags($_POST[self::$username]);      
        }
        if($validationError=='')
        {
        	$validationError = "ok";
        }
		return $validationError;

    }

    //CREATE SET-FUNCTION 
	public function setRequestUserName($username)
	{
		$_POST[self::$username] = $username;
		var_dump($username);
	}

	public function response(){
        
        $response = $this->generateRegisterHTML($this->message);
		
		return $response;

	}

	
	public function setUserExistsMessage()
	{
       $this->setMessage("User exists, pick another username.");
	}

	public function registration()
	{
       $_SESSION['success'] = trim($_POST[self::$username]);
       $this->redirectToStart();
	}

	public function redirectToStart()
	{
		$start = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        header("Location: $start");
	}


	 /*
     * Resets message!
     */
    public function resetMessage()
    {
       $message = '';
    }

    /*
     * setter for message
     */
    public function setMessage($message)
    {
          $this->message = $message;
    }

	public function generateRegisterHTML($message){

		return '
			<h2>Register new user</h2>
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$username . '">UserName :</label>
					<input type="text" id="' . self::$username . '" name="' . self::$username . '" value="' . $this->getRequestUserName() . '" />
					<br />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<br />
					<label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					<br />
					<input type="submit" name="' . self::$Register . '" value="Register" />
				</fieldset>
			</form>
		';
	}
	public function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME

		if(isset($_POST[self::$username])) {
			 return $_POST[self::$username];
		} else {
			 return '';
		}
	}
	public function getRequestPassword() {
		//RETURN REQUEST VARIABLE: PASSWORD

		if(isset($_POST[self::$password])) {
			 return $_POST[self::$password];
		} else {
			 return '';
		}
	}
	public function getRequestPasswordRepeat() {
		//RETURN REQUEST VARIABLE: PASSWORDREPEAT

		if(isset($_POST[self::$passwordRepeat])) {
			  return $_POST[self::$passwordRepeat];
		} else {
			  return '';
		}
	}

	// If register button is pressed
	public function isRegisterPosted() {
		return isset($_POST[self::$Register]);
	}

}