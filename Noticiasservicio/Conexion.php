<?php
/**
 * Description of Conexion
 *
 * @author JuanJosePonce
 */
class Conexion {
    public static function conectar(){
        $opciones =array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");
    $bdo = new PDO('mysql:host=localhost;dbname=noticias', 'root', 'usuario',$opciones);
    return $bdo;
    }
}
