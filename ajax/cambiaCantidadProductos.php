<?php
    $productos=unserialize($_COOKIE['productos']);
    foreach ($productos as $key => $value) {
        if($_REQUEST['id']==$value['id']){
            if($_REQUEST['tipo']=="mas")
                $productos[$key]['cantidad']++;
            else
                $productos[$key]['cantidad']--;
        }
    }
    setcookie("productos",serialize($productos));
    echo json_encode($productos);
?>