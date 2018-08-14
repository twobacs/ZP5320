<?php

$html='';
if(isset($_SESSION['identifiedUser'])){
   $html='<div class="btn-group-vertical">';
   //Bouton Missions
   if(isset($_SESSION['accessMissions'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Missions')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="Missions" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=missions&action=accueil\';">';
   }
   
   //Bouton Gardes
   if(isset($_SESSION['accessGardes'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Gardes')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="Gardes" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=gardes&action=accueil\';">';
   }
   
   //Bouton Utilisateurs
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Utilisateurs')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="Utilisateurs" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=users&action=accueil\';">';
   }
   
	//Bouton E’NOS’INFOS
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Enosinfos')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="E’NOS’INFOS" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=Enosinfos&action=listUsers\';">';
   }
   
   	//Bouton Infos
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Infos')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="Infos" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=Infos&action=accueil\';">';
   }
   
	//Bouton Documentation
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Documentation')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="Documentation" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=Documentation&action=accueil\';">';
   }
   
	//Bouton PlanU
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="';
       $html.=($_SESSION['actualComponent']==='Planu')? 'btn btn-success' : 'btn btn-primary';
       $html.='" value="PlanU" style="cursor:pointer;height:75px;" onclick="window.location.href=\'index.php?component=Planu&action=accueil\';">';
   }   
   
   //Bouton I+Belgium
   if(isset($_SESSION['accessUtilisateurs'])){
       $html.='<input type="button" class="btn btn-info" value="I+ Belgium" style="cursor:pointer;height:75px;" onclick="window.open(\'https://www.polcom.be/index.php\', \'_blank\');">';
   }
}
$html.='</div>';
$this->Left=$html;