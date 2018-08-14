<?php

class VUsers extends VBase {
	
	private $grades=array('CDP','1CP','CP','1INPP','INPP','1INP','INP','AGT','Consultant A','Consultant B','Consultant C','Consultant D','Consultant E');
	private $services=array('APP','DIR','INT','QUA','SER');
	
    function __construct($appli, $model) {
        parent::__construct($appli, $model);
    }
	
    public function homepage(){
        $deco= filter_input(INPUT_GET, 'deco');
        $error= filter_input(INPUT_GET, 'error');
		$timeout= filter_input(INPUT_GET, 'timeout');
        $html='';
        $html.='';
        $html.='
            <div class="login-page">
            <h2>Identification</h2>
                <div class="form">
                <form class="login-form" method="POST" action="index.php?component=users&action=login">
                <input type="text" name="login" placeholder="Identifiant (Matricule)"/>
                <input type="password" name="pass" placeholder="Mot de passe"/>
                <button><img src="/5320/media/images/logo_Vales.png" style="width:100px;"</button>';
                $html.=(isset($deco)?'<p class="message">D&eacute;connexion ok</p>':"");
                $html.=(isset($error)?'<p class="message">Erreur d\'identfiant ou de mot de passe</p>':"");
				$html.=(isset($timeout)?'<p class="message">Votre session a expir&eacute;, veuillez vous reconnecter</p>':"");
                $html.='</form>
                </div>
            </div>';
        $this->appli->Content=$html;
    }
	
   public function bienvenue($opt){        
        $html='Bonjour '.$_SESSION['prenom'].'<br />';
		if($opt=='1'){
			$html.='Vous n\'avez pas acc&egrave;s &agrave; cette partie du site';
			}
        $this->appli->Content=$html;
    }	
    
    public function accueil($access){        
        $html='<div class="btn-group-vertical">
		<button type="button" class="btn btn-primary" onclick="window.location.href=\'?index.php&component=users&action=listUsers\';">Lister les utilisateurs</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href=\'?index.php&component=users&action=add\';">Ajouter un utilisateur</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href=\'?index.php&component=users&action=modify\';">Modifier un utilisateur</button>
		<button type="button" class="btn btn-primary" onclick="window.location.href=\'?index.php&component=users&action=types\';">Cat&eacute;gories utilisateurs</button>
		</div>';
        $this->appli->Content=$html;
    }
	
	public function listUsers($users){
		$index=(isset($_GET['index']) ? $_GET['index'] : '%' );
		$html='<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups" style="display:block;">
		<div class="btn-group" role="group" aria-label="First group">';
		foreach(range('A','M') as $i) {
			$html.='<button type="button" style="width:40px;"class="';
			$html.=(($index==$i) ? 'btn btn-primary' : 'btn btn-secondary');
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=listUsers&index='.$i.'\';">'.$i.'</button>';
		}
		$html.='</div><div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups" style="display:block;">
		<div class="btn-group" role="group" aria-label="First group">';
		foreach(range('N','Z') as $i) {
			$html.='<button type="button" style="width:40px;" class="';
			$html.=(($index==$i) ? 'btn btn-primary' : 'btn btn-secondary');
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=listUsers&index='.$i.'\';">'.$i.'</button>';
		}
		//$html.='<button type="button" class="btn btn-secondary" onclick="window.location.href=\'?index.php&component=users&action=listUsers&index=%\';">TOUS</button>';
		$html.='</div></div><br />';	
		$html.='<table class="table table-hover" style="text-align:left;">
		<thead><tr><th scope="col" style="width:30%;">Nom</th><th scope="col" style="width:30%;">Pr&eacute;nom</th><th scope="col" style="width:30%;">Matricule</th><th>Actif</th></tr></thead><tbody>';
		foreach($users as $row){
			$html.='<tr onclick="showInfosUser(\''.$row['login'].'\');" style="cursor:pointer;"><th scope="row">'.$row['nom'].'</th><td>'.$row['prenom'].'</td><td>'.$row['login'].'</td><td>';
			$html.=($row['actif']=='1' ? '<img src="/5320/media/icons/true.png" style="height:30px;">' : '<img src="/5320/media/icons/false.png" style="height:30px;">');
			$html.='</td></tr>';
			}
		$html.='</tbody></table></div>';
		$this->appli->Content=$html;
	}
	
	public function formAddUser($a=0){
	$html='<h5>Ajout d\'un utilisateur</h5>';
	$html.=($a==1)?'<h6>Utilisateur ajout&eacute; avec succ&egrave;s</h6>' : '';
	$html.='<form method="POST" action="?component=users&action=add&step=1">';
	$html.='<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Nom</div>
					</div>
					<input type="text" class="form-control" name="nom" id="nom" required>
				</div>	
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Pr&eacute;nom</div>
					</div>
					<input type="text" class="form-control" name="prenom" id="prenom" required onfocusout="addMail();">
				</div>	
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Sexe</div>
					</div>
					<select class="custom-select mr-sm-2" name="sexe" id="sexe">
					<option value="M">Masculin</option>
					<option value="F">F&eacute;minin</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Grade</div>
					</div>
					<select class="custom-select mr-sm-2" name="grade" id="grade">';
					foreach($this->grades as $row){
					$html.='<option value="'.$row.'">'.$row.'</option>';
					}
					$html.='</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Service</div>
					</div>
					<select class="custom-select mr-sm-2" name="service" id="service">';
					foreach($this->services as $row){
						$html.='<option value="'.$row.'">'.$row.'</option>';
						}
					$html.='</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Acc&egrave;s</div>
					</div>
					<select class="custom-select mr-sm-2" name="acces" id="acces">
					<option value="1">Utilisateur</option>
					<option value="5">Administrateur</option>
					<option value="10">Super Administrateur</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Matricule</div>
					</div>
					<input type="text" class="form-control" name="matricule" id="matricule" onkeyup="verifMatricule();" required>
				</div>	
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Mail</div>
					</div>
					<input type="text" class="form-control" name="mail" id="mail">
				</div>	
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">GSM</div>
					</div>
					<input type="text" class="form-control" name="gsm" id="gsm">
				</div>	
			</div>
			<div class="form-group">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text" style="width:92px;">Tel</div>
					</div>
					<input type="text" class="form-control" name="tel" id="tel" aria-describedby="emailHelp">					
				</div>	
				<small id="emailHelp" class="form-text text-muted">Le mot de passe cr&eacute;&eacute; par d&eacute;faut est : azerty</small>
			</div>
			<div class="btn-group-vertical">
				<button class="btn btn-primary" type="submit" id="bEnregistrer">Enregistrer</button>
			</div>
			</form>';
	$this->appli->Content=$html;
	}
}