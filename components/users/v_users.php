<?php

class VUsers extends VBase {

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
                <button>Entrer</button>';
                $html.=(isset($deco)?'<p class="message">D&eacute;connexion ok</p>':"");
                $html.=(isset($error)?'<p class="message">Erreur d\'identfiant ou de mot de passe</p>':"");
				$html.=(isset($timeout)?'<p class="message">Votre session a expir&eacute;, veuillez vous reconnecter</p>':"");
                $html.='</form>
                </div>
            </div>';
        $this->appli->Content=$html;
    }
	
   public function bienvenue(){        
        $html='Bonjour '.$_SESSION['prenom'];
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
		<thead><tr><th scope="col" style="width:30%;">Nom</th><th scope="col" style="width:30%;">Pr&eacute;nom</th><th scope="col" style="width:30%;">Matricule</th></tr></thead><tbody>';
		foreach($users as $row){
			$html.='<tr onclick="showInfosUser(\''.$row['login'].'\');" style="cursor:pointer;"><th scope="row">'.$row['nom'].'</th><td>'.$row['prenom'].'</td><td>'.$row['login'].'</td></tr>';
			}
		$html.='</tbody></table></div>';
		$this->appli->Content=$html;
		}
}