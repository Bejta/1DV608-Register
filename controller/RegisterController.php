<?php

namespace controller;

class RegisterController{

	private $view;
	private $model;
	private $dtv;
	private $lv;
	private $dal;


    public function __construct(\view\RegisterView $view, \model\LoginModel $model, \view\DateTimeView $dtv,\view\LayoutView $lv, \model\DAL $dal) {

			$this->view = $view;
			$this->model = $model;
			$this->dal = $dal;
	        $this->dtv = $dtv;
	        $this->lv = $lv;
		}

	public function RunApp(){


        /*
         * Checks if user tried to register
         */
		if ($this->view->isRegisterPosted()) {
             

             // Variable flag checks validation. If it's ok then tries to save new user.
			 // TODO: Validation function should return boolean, and set the messages in the body of function
			 $flag=$this->view->validation();

			 if($flag=="ok")
			 {
			 	 if($this->dal->IfExists($this->view->getRequestUserName()))
	             {
	                   $this->view->setUserExistsMessage();
	             }
	             else
	             {
	             	$this->dal->addUser($this->view->getRequestUserName(),$this->view->getRequestPassword());
	             	$logv = new \view\LoginView($this->model);
	             	$this->view->registration();
	             }

			 }
			 else
			 {
                $this->view->setMessage($flag);
			 }

		}
 
		$lv = new \view\LayoutView();
        $dtv = new \view\DateTimeView();
        $this->lv->render($this->model->isLoggedIn(), $this->view, $dtv);

	}
}