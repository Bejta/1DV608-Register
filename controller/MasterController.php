<?php

namespace controller;

require_once("view/LoginView.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("model/LoginModel.php");
require_once("model/RegisterModel.php");
require_once("model/DAL.php");
require_once("controller/RegisterController.php");
require_once("controller/LoginController.php");


class MasterController{

	public function __construct()
	{
        	
	}

	public function Run(){

		//CREATE OBJECTS OF THE VIEWS
		$lm = new \model\LoginModel();
		$rm = new \model\RegisterModel();

		$v = new \view\LoginView($lm);
		$rv = new \view\RegisterView($m);
		$dtv = new \view\DateTimeView();
		$lv = new \view\LayoutView();
		$dal = new \model\DAL();

		
		if ($_SERVER['QUERY_STRING'] == "register=1" || $_SERVER['QUERY_STRING'] == "register")
		{
            $rc = new RegisterController($rv,$lm,$dtv,$lv,$dal);
            $rc->RunApp();
        } 
        else 
        {
            $lc = new LoginController($v,$lm,$dtv);
            $lc->RunApp();
        }

	}
}