<?php
	require_once("../conexion/bdd_pw.php");

	ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);

	$sql = "SELECT url_produccion, token FROM apis_externas WHERE api = 'WO'";
  	$req = $bdd_pw->prepare($sql); $req->execute();
  	$api_wo  = $req->fetch();

?>