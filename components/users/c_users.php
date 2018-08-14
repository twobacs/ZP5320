<?php

class CUsers extends CBase {

    public function __construct($appli) {
        parent::__construct($appli);
    }

    public function homepage(){
        $this->view->homepage();
    }
    
    public function login(){
        $logged=$this->model->login();
        if($logged){
            $this->view->bienvenue('0');
        }
        else{
            header("location:index.php?error");
        }
    }    
    
    public function logoff(){
        session_unset();
        session_destroy();    
        header("location:index.php?deco");
    }
    
    public function accueil(){
		if(isset($_SESSION['identifiedUser'])){
        $_SESSION['actualComponent']='Utilisateurs';		
		$_SESSION['actualAction']='listUsers';
        $access=$_SESSION['accessUtilisateurs'];
		$users=$this->model->getListUsers();
		$this->view->listUsers($users);
		}
		else{
			header("location:index.php?timeout");
			}
    }
	
	public function listUsers(){
		if(isset($_SESSION['identifiedUser'])){
			$_SESSION['actualComponent']='Utilisateurs';
			$_SESSION['actualAction']='listUsers';
			$nivAcces= $_SESSION['accessUtilisateurs'];
			if($nivAcces>'0'){
				$users=$this->model->getListUsers();
				$this->view->listUsers($users);
				}
			else{
				$this->view->bienvenue('1');
				}
			}
		else{
			header("location:index.php?timeout");
		}
		
	}
	
	public function add(){
		if(isset($_SESSION['identifiedUser'])){
			$_SESSION['actualComponent']='Utilisateurs';
			$_SESSION['actualAction']='addUser';
			$nivAcces= $_SESSION['accessUtilisateurs'];
			if($nivAcces>'0'){
				if(isset($_GET['step'])){
						$a=$this->model->addUser();
						$this->view->formAddUser($a);
					}
				else{	
					$this->view->formAddUser();
				}
			}
			else{
				$this->view->bienvenue('1');
				}
		}
		else{
			header("location:index.php?timeout");
		}
	}
	
	public function modify(){
		if(isset($_SESSION['identifiedUser'])){
			$_SESSION['actualAction']='modifUser';
		}
		else{
			header("location:index.php?timeout");
		}
	}

	public function types(){
		if(isset($_SESSION['identifiedUser'])){
			$_SESSION['actualAction']='userCategs';
		}
		else{
			header("location:index.php?timeout");
		}
	}	
}