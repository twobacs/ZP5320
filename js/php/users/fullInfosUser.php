<?php

include('../connect.php');
$idUser=filter_input(INPUT_GET,'idUser');
$sql='SELECT id_user, nom, prenom, grade, service, login, sexe, mail, tel, gsm, actif FROM utilisateurs WHERE login=:user';
$req=$pdo->prepare($sql);
$req->bindValue('user',$idUser,PDO::PARAM_INT);
$req->execute();
foreach($req as $row){
	$idUser=$row['id_user'];
	$nom=$row['nom'];
	$prenom=$row['prenom'];
	$grade=$row['grade'];
	$service=$row['service'];
	$matricule=$row['login'];
	$sexe=$row['sexe'];
	$mail=$row['mail'];
	$tel=$row['tel'];
	$gsm=$row['gsm'];
	$actif=$row['actif'];
	}
$sql='SELECT access FROM access WHERE id_user=:u';
$req=$pdo->prepare($sql);
$req->bindValue('u',$idUser,PDO::PARAM_INT);
$req->execute();
foreach($req as $row){
	$acces=$row['access'];
	}
$html='
<form style="margin-top:30%;">
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Nom</div>
		</div>
		<input type="text" class="form-control" id="nom" value="'.$nom.'">
	</div>	
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Pr&eacute;nom</div>
		</div>
		<input type="text" class="form-control" id="prenom" value="'.$prenom.'">
	</div>	
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Grade</div>
		</div>
		<select class="custom-select mr-sm-2" id="grade">';
		foreach($grades as $row){
			$html.='<option value="'.$row.'"';
			$html.=($row==$grade) ?' selected':'';
			$html.='>'.$row.'</option>';
			}
		$html.='</select>
	</div>
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Acc&egrave;s</div>
		</div>
		<select class="custom-select mr-sm-2" id="acces" name="acces">';
		if($acces==''){
			$html.='<option value="N"selected>Non configur&eacute;</option>';
			}
		$html.='<option value="1"';
		$html.=($acces=='1') ? ' selected' : '';
		$html.='>Utilisateur</option>
		<option value="5"';
		$html.=($acces=='5') ? ' selected' : '';
		$html.='>Administrateur</option>
		<option value="10"';
		$html.=($acces=='10') ? ' selected' : '';
		$html.='>Super Administrateur</option>
		</select>
	</div>
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Service</div>
		</div>
		<select class="custom-select mr-sm-2" id="service">';
		foreach($services as $row){
			$html.='<option value="'.$row.'"';
			$html.=($row==$service) ?' selected':'';
			$html.='>'.$row.'</option>';
			}
		$html.='</select>
	</div>
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Matricule</div>
		</div>
		<input type="text" class="form-control" id="matricule" value="'.$matricule.'">
	</div>	
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Mail</div>
		</div>
		<input type="text" class="form-control" id="mail" value="'.$mail.'">
	</div>	
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">GSM</div>
		</div>
		<input type="text" class="form-control" id="gsm" value="'.$gsm.'">
	</div>	
</div>
<div class="form-group">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text" style="width:92px;">Tel</div>
		</div>
		<input type="text" class="form-control" id="tel" value="'.$tel.'">
	</div>	
</div>
<div class="btn-group-vertical">
<button class="btn btn-primary" type="button" id="bEnregistrer" onclick="modifUser(\''.$idUser.'\');">Enregistrer modifications</button>';
if($actif=='1'){
	$html.='<button class="btn btn-dark" type="button" id="bDeactive" onclick="deReactiveUser(\''.$idUser.'\',0);">D&eacute;sactiver utilisateur</button>';	
}
else{
	$html.='<button class="btn btn-info" type="button" id="bDeactive" onclick="deReactiveUser(\''.$idUser.'\',1);">R&eacute;activer utilisateur</button>';	
}
$html.='</div>
</div>
</form>
';
echo $html;