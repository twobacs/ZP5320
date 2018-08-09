<?php

$path = $this->pathWebApp
        . PATH_SEPARATOR . $this->pathWebApp . 'class'
        . PATH_SEPARATOR . './class'
        . PATH_SEPARATOR . $this->pathWebApp . 'components/base'
        . PATH_SEPARATOR . './components/base'
        . PATH_SEPARATOR . $this->pathWebApp . 'libraries'
        . PATH_SEPARATOR . './configuration';

set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once($this->pathWebApp.'components/base/c_base.php');
require_once($this->pathWebApp.'components/base/m_base.php');
require_once($this->pathWebApp.'components/base/v_base.php');

$this->tplBasePath = 'templates/';
$this->tplPath = 'unbo/';  //Le nom du dossier contenant le template dans le dossier template
$this->tplIndex = 'index.html';

define("IP",	$_SERVER['SERVER_ADDR']);
define("MEDIA",		'../media/');

//**

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__FILE__).DS);
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');

//**

$this->pathArticles = 'articles/';

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$pdo = new PDO('mysql:host=localhost;dbname=5320','root','Vales5320+',$pdo_options);
$this->dbPdo = $pdo;

$this->defaultComponent = 'users';  //Composant appelé par défaut à l'arrivée sur la page index.php
$this->defaultAction = 'homepage'; //Action appelée par défaut à l'arrivée sur la page index.php

?>