<?php

if(isset($_GET['idUser'])){
	include ('../connect.php');
	$idUser=filter_input(INPUT_GET,'idUser');
	$actif=filter_input(INPUT_GET,'actif');
	$sql='UPDATE utilisateurs SET actif=:a WHERE id_user=:idUser';
	$req=$pdo->prepare($sql);
	$req->bindValue('a',$actif,PDO::PARAM_INT);
	$req->bindValue('idUser',$idUser,PDO::PARAM_INT);
	$req->execute();
	echo $req->rowCount();
	}