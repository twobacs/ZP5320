<?php
$html='';
if(isset($_SESSION['identifiedUser'])){
   $html='<input type="button" class="btn btn-danger" value="D&eacute;connexion" style="cursor:pointer;" onclick="window.location.href=\'?index.php&component=users&action=logoff\';">';
}
$this->Foot=$html;