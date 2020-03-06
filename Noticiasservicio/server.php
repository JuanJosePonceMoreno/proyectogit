<?php

include_once 'lib/nusoap.php';
$servicio = new soap_server();

$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("MiPrimerServicioWeb", $ns);
$servicio->schemaTargetNamespace = $ns;
$servicio->register("MiFuncion", array('idCategoria' => 'xsd:integer', 'fecha' => 'xsd:string'), array('return' => 'xsd:Array'), $ns);

function MiFuncion($idCategoria, $fecha) {
    $bd = conectar();
    $result = $bd->query("Select * from noticias where categoria=$idCategoria and fecha='$fecha'");
    if ($result) {
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return $resultado;
}

function conectar() {
    return new PDO("mysql:host=localhost;dbname=noticias", "root", "usuario");
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service(file_get_contents("php://input"));
?>