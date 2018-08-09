<?php

class MUsers extends MBase {

	private $checkDbPDO = false;

	public function __construct($appli) {
		parent::__construct($appli);
		
	}
    public function login(){
        $login= htmlentities(filter_input(INPUT_POST, 'login'));
        $pass= filter_input(INPUT_POST, 'pass');
        
        $sql='SELECT id_user, nom, prenom, password FROM utilisateurs WHERE login=:login';
        $req=$this->appli->dbPdo->prepare($sql);
        $req->bindValue('login',$login, PDO::PARAM_STR);
        $req->execute();
        foreach($req as $row){
            $passBDD=$row['password'];
            if(password_verify($pass, $passBDD)){
                $_SESSION['idUser']=$row['id_user'];
                $_SESSION['nom']=$row['nom'];
                $_SESSION['prenom']=$row['prenom'];
                $_SESSION['identifiedUser']=1;
                $this->setAccess($_SESSION['idUser']);
                return true;
            }
            else {
                return false;            
            }            
        }
    }
    
    private function setAccess($idUser){
        $_SESSION['accessMissions']=0;
        $_SESSION['accessGardes']=0;
        $_SESSION['accessUtilisateurs']=0;
        $_SESSION['actualComponent']=0;
        $sql='SELECT id_component, access FROM access WHERE id_user=:idUser';
        $req=$this->appli->dbPdo->prepare($sql);
        $req->bindValue('idUser',$idUser, PDO::PARAM_INT);
        $req->execute();
        foreach($req as $row){
            if($row['id_component']==='1'){
                $_SESSION['accessMissions']=$row['access'];
            }
            if($row['id_component']==='2'){
                $_SESSION['accessGardes']=$row['access'];
            }
            if($row['id_component']==='3'){
                $_SESSION['accessUtilisateurs']=$row['access'];
            }
        }
    }
	
	
	public function getListUsers(){
			$sql='SELECT nom, prenom, grade, login, sexe, mail, tel, gsm FROM utilisateurs ';
			$sql.=(isset($_GET['index']) ? 'WHERE nom LIKE "'.$_GET['index'].'%"':'');
			$sql.='ORDER BY nom, prenom';
			$req=$this->appli->dbPdo->prepare($sql);
			$req->execute();
			return $req;
		}
}