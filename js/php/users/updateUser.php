<?php

$idUser=filter_input(INPUT_GET,'idUser');
$nom=filter_input(INPUT_GET,'nom');
$prenom=filter_input(INPUT_GET,'prenom');
$grade=filter_input(INPUT_GET,'grade');
$service=filter_input(INPUT_GET,'service');
$matricule=filter_input(INPUT_GET,'matricule');
$mail=filter_input(INPUT_GET,'mail');
$gsm=filter_input(INPUT_GET,'gsm');
$tel=filter_input(INPUT_GET,'tel');
$acces=filter_input(INPUT_GET,'acces');
//echo $idUser;
if(isset($idUser)){
	include('../connect.php');
	$sql='UPDATE utilisateurs SET nom=:nom, prenom=:prenom, grade=:grade, service=:service, login=:login, mail=:mail, gsm=:gsm, tel=:tel WHERE id_user=:idUser';
	//echo $sql;
	$req=$pdo->prepare($sql);
	$req->bindValue('nom',$nom,PDO::PARAM_STR);
	$req->bindValue('prenom',$prenom,PDO::PARAM_STR);
	$req->bindValue('grade',$grade,PDO::PARAM_STR);
	$req->bindValue('service',$service,PDO::PARAM_STR);
	$req->bindValue('login',$matricule,PDO::PARAM_STR);
	$req->bindValue('mail',$mail,PDO::PARAM_STR);
	$req->bindValue('gsm',$gsm,PDO::PARAM_STR);
	$req->bindValue('tel',$tel,PDO::PARAM_STR);
	$req->bindValue('idUser',$idUser,PDO::PARAM_INT);
	$req->execute();
	$count=$req->rowCount();
	$sql='SELECT COUNT(*) FROM access WHERE id_user=:u';
	$reqa=$pdo->prepare($sql);
	$reqa->bindValue('u',$idUser,PDO::PARAM_INT);
	$reqa->execute();
	
	foreach($reqa as $rowa){
		$c=$rowa['COUNT(*)'];
		}
	$sqlb='SELECT id_component FROM components';
		$reqb=$pdo->prepare($sqlb);
		$reqb->execute();
	if($c=='0'){
		foreach($reqb as $rowb){
			$sqla='INSERT INTO access (id_user, id_component, access) VALUES (:u, :i, :a)';
			$reqa=$pdo->prepare($sqla);
			$reqa->bindValue('u',$idUser,PDO::PARAM_INT);
			$reqa->bindValue('i',$rowb['id_component'],PDO::PARAM_INT);
			$reqa->bindValue('a',$acces,PDO::PARAM_INT);
			$reqa->execute();
			$count=$reqa->rowCount();
		}
	}
	else{
		$sqla='UPDATE access SET access=:a WHERE id_user=:u';
		$reqa=$pdo->prepare($sqla);
		$reqa->bindValue('u',$idUser,PDO::PARAM_INT);
		$reqa->bindValue('a',$acces,PDO::PARAM_INT);
		$reqa->execute();
		$count=$reqa->rowCount();
	}
	echo $count;
	}