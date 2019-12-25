<?php 

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//esto se necesita para recibir parametros con Axios
//Axio lo estamos usando para procesar las peticiones http
$_POST = json_decode(file_get_contents("php://input"), true);

//Recibimos los datos enviados mediante POST desde main.js
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';

switch ($opcion){
    case 1: //Damos de alta al registro
        $consulta = "INSERT INTO moviles (moviles_marca, moviles_modelo, moviles_stock) VALUES('$marca', '$modelo', '$stock')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
    break;
    case 2: //Modificaremos el registro
        $consulta = "UPDATE moviles  SET moviles_marca='$marca', moviles_modelo='$modelo', moviles_stock='$stock' WHERE moviles_id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
    case 3: //Eliminamos el registro
        $consulta = "DELETE FROM moviles WHERE  moviles_id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
    break;
    case 4: //Listamos los registros
        $consulta = "SELECT moviles_id, moviles_marca, moviles_modelo, moviles_strock FROM moviles";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
}
//Enviamos el array final en formato JSON a JavasCript
print json_decode($data, JSON_UNESCAPED_UNICODE);

$conexion= NULL;