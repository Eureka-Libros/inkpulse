<?php

	require_once("aut.php"); 
	require_once('../conexion/bdd.php');
	
	
	foreach ($_POST['libro_m'] as $libros => $libro) {
	   
	    if (empty($libro)) {
	        continue;
	    }

	    list($editorial, $materia, $grado, $libro_nombre, $vigencia) = explode('/', $libro);

	   
	    $sql_p = "INSERT INTO mercado_editorial(id_periodo,id_colegio,id_materia,id_grado,editorial,libro,vigencia,id_usuario) 
	              VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

	    $query_p = $bdd->prepare($sql_p);

	    if ($query_p == false) {
	        print_r($bdd->errorInfo());
	        die('Erreur prepare');
	    }

	    // Se pasan las variables de forma segura para prevenir inyección SQL
	    $sth_p = $query_p->execute([
	        $_POST['periodo'],
	        $_POST['id_colegio'],
	        $materia,
	        $grado,
	        $editorial,
	        $libro_nombre,
	        $vigencia,
	        $_SESSION['id']
	    ]);

	    if ($sth_p == false) {
	        print_r($query_p->errorInfo());
	        die('Erreur execute');
	    }
	}

	header('Location: ../colegio.php?codigo='.$_POST["cod_colegio"].'&periodo='.$_POST["periodo"].'');
	
?>