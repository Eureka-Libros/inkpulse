<?php
	/**
	 * /includes/api_cliente.php
	 * Conector base adaptado para World Office Cloud mediante curl_setopt_array.
	 */

	require_once __DIR__ . '/../config/api_config.php';

	/**
	 * Realiza una petición estructurada a la API de World Office.
	 *
	 * @param string $endpoint Ruta del endpoint (ej: 'inventarios/listarDocumentoSalidaAlmacen').
	 * @param string $metodo Método HTTP ('GET', 'POST', etc.). Para listar suele ser POST o GET.
	 * @param array|null $datos Cuerpo de la petición en formato array de PHP.
	 * @return array Respuesta de World Office decodificada.
	 */
	function hacer_peticion_api($endpoint, $metodo = 'POST', $datos = null) {
	    $url_completa = API_URL_BASE . $endpoint;
	    $ch = curl_init();
	    
	    // Cabeceras exactas que necesita World Office
	    $cabeceras = [
	        'Content-Type: application/json',
	        'Authorization: ' . API_TOKEN
	    ];
	    
	    // Array de configuración estructural idéntico al de tu documentación
	    $opciones_curl = [
	        CURLOPT_URL => $url_completa,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => '',
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,          // Permite que peticiones pesadas no se corten
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Completado de tu fragmento
	        CURLOPT_CUSTOMREQUEST => strtoupper($metodo),
	        CURLOPT_HTTPHEADER => $cabeceras
	    ];
	    
	    // Si la API te pide enviar filtros, rangos de fechas o datos, los adjuntamos en JSON
	    if ($datos !== null) {
	        $opciones_curl[CURLOPT_POSTFIELDS] = json_encode($datos);
	    }
	    
	    // Aplicamos todas las opciones en un solo bloque estructurado
	    curl_setopt_array($ch, $opciones_curl);
	    
	    $respuesta = curl_exec($ch);
	    
	    // Control de errores de red
	    if (curl_errno($ch)) {
	        $error_msg = curl_error($ch);
	        curl_close($ch);
	        return [
	            'status' => 'error',
	            'mensaje_interno' => 'Error físico de conexión: ' . $error_msg
	        ];
	    }
	    
	    curl_close($ch);
	    
	    $resultado = json_decode($respuesta, true);
	    
	    if ($resultado === null) {
	        return [
	            'status' => 'error',
	            'mensaje_interno' => 'World Office no devolvió un formato JSON válido.',
	            'respuesta_cruda' => $respuesta
	        ];
	    }
	    
	    return $resultado;
	}