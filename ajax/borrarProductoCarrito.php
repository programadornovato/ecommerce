<?php
    $productos=unserialize($_COOKIE['productos']);
    foreach ($productos as $key => $value) {
        if($_REQUEST['id']==$value['id']){
            unset($productos[$key]);
        }
    }
    $productos=array_values($productos);
    setcookie("productos",serialize($productos));
    echo json_encode($productos);
?>