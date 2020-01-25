<?php
    $productos= unserialize($_COOKIE['productos']??'');
    echo json_encode($productos);
?>