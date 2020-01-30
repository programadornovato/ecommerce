<?php
    $total=$_REQUEST['total']??'';
    include_once "stripe/init.php";
    \Stripe\Stripe::setApiKey("sk_test_JaTXHOFLk3lllnj1PnpahfxR00NLGmUe8M");
    $toke=$_POST['stripeToken'];
    $charge=\Stripe\Charge::create([
        'amount'=>$total,
        'currency'=>'usd',
        'description'=>'Pago de ecommerce',
        'source'=>$toke
    ]);
    if($charge['captured']){
        $queryVenta="INSERT INTO ventas 
        (idCli                       ,idPago             ,fecha) values
        ('".$_SESSION['idCliente']."','".$charge['id']."',now());
        ";
        $resVenta=mysqli_query($con,$queryVenta);
        $id=mysqli_insert_id($con);
        /*
        if($resVenta){
            echo "La venta fue exitosa con el id=".$id;
        }
        */
        $insertaDetalle="";
        $cantProd=count($_REQUEST['id']);
        for($i=0;$i<$cantProd;$i++){
            $subTotal=$_REQUEST['precio'][$i]*$_REQUEST['cantidad'][$i];
            $insertaDetalle=$insertaDetalle."('".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','$subTotal'),";
        }
        $insertaDetalle=rtrim($insertaDetalle,",");
        $queryDetalle="INSERT INTO detalleVentas 
        (id, idProd, idVenta, cantidad, precio, subTotal) values 
        $insertaDetalle;";
        $resDetalle=mysqli_query($con,$queryDetalle);
        if($resVenta && $resDetalle){
            
        }
    }
?>