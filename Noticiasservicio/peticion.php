
<?php
include './lib/nusoap.php';
$url = "http://localhost/ProyectosPHP/Noticiasservicio/server.php?wsdl";

$parametros = json_decode($_REQUEST['json']);
try {
    $client = new nusoap_client($url);
    $result = $client->call("MiFuncion", [
        "categoria" => $parametros->categoria,
        "fecha" =>  $parametros->fecha
    ]);
    
    echo json_encode($result);
} catch (SoapFault $e) {
    echo $e->getMessage();
}
echo PHP_EOL;
?>