<?php

/* 
 * Created by De Backer Jeremy with NetBeans IDE
 * Contact : jeremy.debacker@police.belgium.eu
 * Property of Zone de Police du Val de l'Escaut
 */


class CMissions extends CBase {

    public function __construct($appli) {
        parent::__construct($appli);
    }
    
    public function accueil(){
        $_SESSION['actualComponent']='Missions';
		$_SESSION['actualAction']='';
        $access=$_SESSION['accessMissions'];
        $this->appli->Content='Missions '.$access;
    }
}