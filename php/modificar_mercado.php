<?php
	require_once("../php/aut.php");
	include("../conexion/bdd.php");

	if (isset($_POST["mercado_m"])) {

		
		
		foreach ($_POST["mercado_m"] as $presups => $presup) {

			list($mercado_id,$tasa_c,$descuento,$precio) = explode("/", $presup);

			$sql = "SELECT columna FROM libros WHERE id='".$libro."'";

			$req = $bdd->prepare($sql);
			$req->execute();
			$con_colum = $req->fetch();		

			if ($mercado_id !="") {


				$sql_e = "UPDATE mercado_editorial SET precio='".$precio."', tasa_compra='".$tasa_c."', descuento='".$descuento."' WHERE id='".$mercado_id."'";


				$query_e = $bdd->prepare( $sql_e );
				if ($query_e == false) {
					print_r($bdd->errorInfo());
						die ('Erreur prepare');
					}
				$sth_e = $query_e->execute();
				if ($sth_e == false) {
					print_r($query_e->errorInfo());
					die ('Erreur execute');
				}
					
				
			}

			
		}

	}
	
	//header('Location: ../colegio.php?codigo='.$_POST["codigo"].'&periodo='.$_POST["periodo"].'');


?>