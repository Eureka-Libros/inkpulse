<?php

	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
		
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.worldoffice.cloud/api/v1/inventarios/getDocumentoSalidaAlmacenId/558',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: WO eyJhbGciOiJIUzUxMiJ9.eyJzY2hlbWEiOiJYWlNNTS1BUFRXQi1YSkhVRy1HTlpHQyIsImZlY2hhIjoiMjAyNi03LTktMTc6NDE6NDEiLCJ0ZW5hbnRJZCI6MiwiY2FuYWwiOiJBUEkiLCJzdWIiOiJhcGl3b0Bzb21vc2V1cmVrYS5jb20uY28iLCJpYXQiOjE3ODM2MTg5MDEsImV4cCI6MTgxMzc3Mjc0M30.HvO1XfBVxw8HwrwkxAlOrIlhbUlWCB9OF8rWD_KshmE2PcPntIcSuYzVlji4Q6Lb_5mpUEaAvOlloeSnmuXM9Q'
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	//echo $response;

	// 1. Decodificar la cadena JSON a un array u objeto de PHP
	$data = json_decode($response);

	//Ejemplo 1

	// 1. Obtener un valor del primer nivel
	echo $data->status; // Imprime: ACCEPTED

	// 2. Obtener un valor dentro de "data"
	echo $data->data->numero; // Imprime: 2396

	// 3. Obtener un valor en niveles más profundos (ej. Nombre de la Empresa)
	echo $data->data->empresa->nombre; // Imprime: EUREKA CONTENIDOS EDUCATIVOS SAS

	// 4. Obtener un valor dentro de un array indexado (ej. Nombre del primer Tipo de Tercero)
	echo $data->data->terceroExterno->terceroTipos[0]->nombre; // Imprime: Cliente

	echo "<br><br>";

	//Ejemplo 2

	// Convertir el JSON a un array asociativo de PHP
	$data = json_decode($response, true);

	// Asegurarse de que la consulta fue exitosa y contiene datos
	if (isset($data['status']) && $data['status'] === 'ACCEPTED' && isset($data['data'])) {
	    
	    $info = $data['data'];
	    
	    echo "<style>
	        .json-table { width: 100%; max-width: 600px; border-collapse: collapse; margin-bottom: 20px; font-family: Arial, sans-serif; }
	        .json-table th, .json-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
	        .json-table th { background-color: #f2f2f2; width: 35%; }
	        .table-title { font-family: Arial, sans-serif; color: #333; margin-top: 20px; }
	    </style>";

	    // --- TABLA 1: DATOS GENERALES DEL DOCUMENTO ---
	    echo "<h3 class='table-title'>Información del Documento</h3>";
	    echo "<table class='json-table'>";
	    echo "<tr><th>Estado Consulta</th><td>" . $data['userMessage'] . "</td></tr>";
	    echo "<tr><th>Tipo Documento</th><td>" . $info['documentoTipo']['nombreDocumento'] . " (" . $info['documentoTipo']['codigoDocumento'] . ")</td></tr>";
	    echo "<tr><th>Prefijo / Número</th><td>" . $info['prefijo']['nombre'] . " - " . $info['numero'] . "</td></tr>";
	    echo "<tr><th>Fecha</th><td>" . $info['fecha'] . "</td></tr>";
	    echo "<tr><th>Moneda</th><td>" . $info['moneda']['nombre'] . " (" . $info['moneda']['simbolo'] . ")</td></tr>";
	    echo "<tr><th>Forma de Pago</th><td>" . $info['formaPago']['nombre'] . "</td></tr>";
	    echo "<tr><th>Concepto</th><td>" . $info['concepto'] . "</td></tr>";
	    echo "</table>";

	    // --- TABLA 2: DATOS EMISOR (EMPRESA) ---
	    echo "<h3 class='table-title'>Datos de la Empresa (Emisor)</h3>";
	    echo "<table class='json-table'>";
	    echo "<tr><th>Razón Social</th><td>" . $info['empresa']['nombre'] . "</td></tr>";
	    echo "<tr><th>NIT</th><td>" . $info['empresa']['identificacion'] . "-" . $info['empresa']['digitoVerificacion'] . "</td></tr>";
	    echo "<tr><th>Ciudad / País</th><td>" . $info['empresa']['ubicacionCiudad']['nombre'] . " / " . $info['empresa']['ubicacionCiudad']['ubicacionDepartamento']['ubicacionPais']['nombre'] . "</td></tr>";
	    echo "<tr><th>Información Tributaria</th><td>" . $info['empresa']['infoTributariaAdicional'] . "</td></tr>";
	    echo "</table>";

	    // --- TABLA 3: DATOS RECEPTOR (CLIENTE) ---
	    echo "<h3 class='table-title'>Datos del Cliente (Receptor)</h3>";
	    echo "<table class='json-table'>";
	    echo "<tr><th>Razón Social</th><td>" . $info['terceroExterno']['nombreCompleto'] . "</td></tr>";
	    echo "<tr><th>Identificación</th><td>" . $info['terceroExterno']['terceroTipoIdentificacion'] . ": " . $info['terceroExterno']['identificacion'] . "</td></tr>";
	    echo "<tr><th>Tipo Contribuyente</th><td>" . $info['terceroExterno']['terceroTipoContribuyente'] . "</td></tr>";
	    echo "<tr><th>Dirección</th><td>" . $info['direccionTerceroExterno']['direccion'] . " (" . $info['direccionTerceroExterno']['ciudad'] . ")</td></tr>";
	    echo "<tr><th>Correo Electrónico</th><td>" . $info['direccionTerceroExterno']['emailPrincipal'] . "</td></tr>";
	    echo "</table>";

	} else {
	    echo "<p>Error: El JSON no tiene un estado aceptado o viene vacío.</p>";
	}


?>