<?php

class MUsers extends MBase {

	private $checkDbPDO = false;

	public function __construct($appli) {
		parent::__construct($appli);
		
	}
    public function login(){
        $login= htmlentities(filter_input(INPUT_POST, 'login'));
        $pass= filter_input(INPUT_POST, 'pass');
        
        $sql='SELECT id_user, nom, prenom, password, actif FROM utilisateurs WHERE login=:login';
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
			$sql='SELECT nom, prenom, grade, login, sexe, mail, tel, gsm, actif FROM utilisateurs ';
			$sql.=(isset($_GET['index']) ? 'WHERE nom LIKE "'.$_GET['index'].'%"':'');
			$sql.='ORDER BY nom, prenom';
			$req=$this->appli->dbPdo->prepare($sql);
			$req->execute();
			return $req;
		}
		
	public function addUser(){
		$nom=filter_input(INPUT_POST,'nom');
		$prenom=filter_input(INPUT_POST,'prenom');
		$sexe=filter_input(INPUT_POST,'sexe');
		$grade=filter_input(INPUT_POST,'grade');
		$service=filter_input(INPUT_POST,'service');
		$matricule=filter_input(INPUT_POST,'matricule');
		$mail=filter_input(INPUT_POST,'mail');
		$gsm=filter_input(INPUT_POST,'gsm');
		$tel=filter_input(INPUT_POST,'tel');
		$acces=filter_input(INPUT_POST,'acces');
		$pass=password_hash("azerty", PASSWORD_DEFAULT);
		$sql='INSERT INTO utilisateurs (nom, prenom, grade, service, login, password, sexe, mail, tel, gsm) VALUES (:nom, :prenom, :grade, :service, :login, :password, :sexe, :mail, :tel, :gsm)';
		$req=$this->appli->dbPdo->prepare($sql);
		$req->bindValue('nom',$nom,PDO::PARAM_STR);
		$req->bindValue('prenom',$prenom,PDO::PARAM_STR);
		$req->bindValue('grade',$grade,PDO::PARAM_STR);
		$req->bindValue('service',$service,PDO::PARAM_STR);
		$req->bindValue('login',$matricule,PDO::PARAM_STR);
		$req->bindValue('password',$pass,PDO::PARAM_STR);
		$req->bindValue('sexe',$sexe,PDO::PARAM_STR);
		$req->bindValue('mail',$mail,PDO::PARAM_STR);
		$req->bindValue('tel',$tel,PDO::PARAM_STR);
		$req->bindValue('gsm',$gsm,PDO::PARAM_STR);
		$req->execute();
		$count=$req->rowCount();
		$idUser=$this->appli->dbPdo->lastInsertId();
		$sql='SELECT id_component FROM components';
		$req=$this->appli->dbPdo->prepare($sql);
		$req->execute();
		foreach($req as $row){
			$sqla='INSERT INTO access (id_user, id_component, access) VALUES (:u, :i, :a)';
			$reqa=$this->appli->dbPdo->prepare($sqla);
			$reqa->bindValue('u',$idUser,PDO::PARAM_INT);
			$reqa->bindValue('i',$row['id_component'],PDO::PARAM_INT);
			$reqa->bindValue('a',$acces,PDO::PARAM_INT);
			$reqa->execute();
			}
		return $count;
		}
}