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
        if($resVenta){
            echo "La venta fue exitosa con el id=".$id;
        }
    }
?>