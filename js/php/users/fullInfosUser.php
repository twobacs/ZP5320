<?php

include('../connect.php');
$idUser=filter_input(INPUT_GET,'idUser');
$sql='SELECT nom, prenom, grade, service, login, sexe, mail, tel, gsm FROM utilisateurs WHERE login=:user';
$req=$pdo->prepare($sql);
$req->bindValue('user',$idUser,PDO::PARAM_INT);
$req->execute();
foreach($req as $row){
	$nom=$row['nom'];
	$prenom=$row['prenom'];
	$grade=$row['grade'];
	$service=$row['service'];
	$matricule=$row['matricule'];
	$sexe=$row['sexe'];
	$mail=$row['mail'];
	$tel=$row['tel'];
	$gsm=$row['gsm'];
	}
//print_r($grades);
//echo count($grades);
$html='
<form>
<div class="form-group">
	<!--<label for="nom">Nom</label>-->
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text">Nom</div>
		</div>
		<input type="text" class="form-control" id="nom" value="'.$nom.'">
	</div>	
</div>
<div class="form-group">
	<!--<label for="prenom">Pr&eacute;nom</label>-->
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text">Pr&eacute;nom</div>
		</div>
		<input type="text" class="form-control" id="prenom" value="'.$prenom.'">
	</div>	
</div>
<div class="form-group">
	<!--<label for="grade">Grade</label>-->
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text">Grade</div>
		</div>
		<select class="custom-select mr-sm-2">';
		foreach($grades as $row){
			$html.='<option value="'.$row.'"';
			$html.=($row==$grade) ?' selected':'';
			$html.='>'.$row.'</option>';
			}
		$html.='</select>
	</div>
</div>
</form>
';
echo $html;