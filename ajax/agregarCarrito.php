<?php
    $productos= unserialize($_COOKIE['productos']??'');
    if(is_array($productos)==false)$productos=array();
    $siYaEstaProducto=false;
    foreach ($productos as $key => $value) {
        if($value['id']==$_REQUEST['id']){
            $productos[$key]['cantidad']=$productos[$key]['cantidad']+$_REQUEST['cantidad'];
            $siYaEstaProducto=true;
        }
    }
    if($siYaEstaProducto==false){
        $nuevo=array(
            "id"=>$_REQUEST['id'],
            "nombre"=>$_REQUEST['nombre'],
            "web_path"=>$_REQUEST['web_path'],
            "cantidad"=>$_REQUEST['cantidad'],
            "precio"=>$_REQUEST['precio']
        );
        array_push($productos,$nuevo);
    }
    setcookie("productos",serialize($productos));
    echo json_encode($productos);
    
?>