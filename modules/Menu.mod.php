<?php
$html='';
$actualComponent=(isset($_SESSION['actualComponent']) ? $_SESSION['actualComponent'] : '');
$actualAction=(isset($_SESSION['actualAction']) ? $_SESSION['actualAction'] : '');

switch($actualComponent){
	case 'Utilisateurs':
		if($actualAction!=''){
			$html='<div class="btn-group" role="group">
			<button type="button" class="';
			$html.=($actualAction==='listUsers')? 'btn btn-success' : 'btn btn-primary';
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=listUsers\';">Lister les utilisateurs</button>
			<button type="button" class="';
			$html.=($actualAction==='addUser')? 'btn btn-success' : 'btn btn-primary';
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=add\';">Ajouter un utilisateur</button>';
			/*<button type="button" class="';
			$html.=($actualAction==='modifUser')? 'btn btn-success' : 'btn btn-primary';
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=modify\';">Modifier un utilisateur</button>*/
			/*$html.='<button type="button" class="';
			$html.=($actualAction==='userCategs')? 'btn btn-success' : 'btn btn-primary';
			$html.='" onclick="window.location.href=\'?index.php&component=users&action=types\';">Cat&eacute;gories utilisateurs</button>*/
			$html.='</div>';
		}		
		break;
		
	case 'Missions':
		$html.='Missions';
		
		break;
		
	case 'Gardes':
		$html.='Gardes';
		
		break;
		
	default :
		$html.='';
		break;
	}
$this->Menu=$html;