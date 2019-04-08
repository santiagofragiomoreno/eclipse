<?php
// comprobamos si nos llega algo por GET
include "Connections/openConexionRB.php";
include "utils/validaciones.php";
$dev = 1;
$pro = 0;
if(isset($_GET)){
    if($_GET['codigo_producto'] != '' && $_GET['usuario']){
        //abrimos la conexion con la base de datos
        if($conn = conexionBD($pro)){
            //comprobamos si lo campos son correctos en la BBDD
             $consulta ="SELECT codigo_producto, id_usuario FROM productos WHERE codigo_producto ='".$_GET['codigo_producto']."'";
            //ejecutamos la consulta
            $resultado_consulta = $conn->query($consulta);//nos devuelve un objeto
            $producto = array();
            $contador = 0;
            if($resultado_consulta->num_rows>0){
                while ($fila = $resultado_consulta->fetch_assoc()){
                    $producto[$contador]["codigo_producto"]   = $fila["codigo_producto"];
                    $producto[$contador]["id_usuario"] = $fila["id_usuario"];
                    $contador++;
                }
            }
            print_r($producto);
        
        }
        
    }
    $conn->close();
}
else{
    echo "error en GET";
}