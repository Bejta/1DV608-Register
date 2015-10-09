<?php

namespace model;

class DAL{

	private static $file = "data/UserList.txt";

	public function getUsersList()
	{

		/* 
		 * file() - Reads entire file into an array
		 * Do not add newline at the end of each array element, Skip empty lines
		 * http://php.net/manual/en/function.file.php
		 */
       
		$usersList = file(self::$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$userNames = array();
			
			// For-each loop goes trought array of users, and adds elements with even index in new array
			foreach ($usersList as $k => $v)
			{
			    if ($k % 2 == 0) {
			       $userNames[] = $v;
			    }
			}
			
		return $userNames;
	}
    
    //Takes username as argument. Goes trought array and if username is found, takes next element of array (according password is in the next row)
	public function getPassword($username)
	{
        $usersList = file(self::$file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		
		foreach ($usersList as $k => $v)
			{
			    if ($v == $username) {
			       return $usersList[$k+1];
			    }
			}
	}


    //Checks if username exists in text file
	public function IfExists($username) 
	{

        $usernames = $this->getUsersList();

        foreach ($usernames as $k => $v)
		{
			if ($v == $username) 
			{
			    return true;
			}
		}
        return false;
    }

    //Adds new username and password to the text file.
	public function addUser($username,$password)
	{

        /* 
         * Opens file for writing only, and sets pointer to end of file,
         * http://php.net/manual/en/function.fopen.php
         */
		$myFile = fopen(self::$file, 'a');

		//Write username and password in new line
		fwrite($myFile, $username.PHP_EOL);
		fwrite($myFile, $password.PHP_EOL);
		fclose($myFile);

	}
}