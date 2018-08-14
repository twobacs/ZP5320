<?php

$mat=filter_input(INPUT_GET,'mat');
include ('../connect.php');
$sql='SELECT nom, prenom FROM utilisateurs WHERE login=:mat';
$req=$pdo->prepare($sql);
$req->bindValue('mat',$mat,PDO::PARAM_STR);
$req->execute();
echo $req->rowCount();