<?php
session_start();
include_once "admin/db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);

$queryRecibe="SELECT nombre,email,direccion 
from recibe 
where idCli='".$_SESSION['idCliente']."';";
$resRecibe=mysqli_query($con,$queryRecibe);
$rowRecibe=mysqli_fetch_assoc($resRecibe);

$queryCli="SELECT nombre,email,direccion 
from clientes 
where id='".$_SESSION['idCliente']."';";
$resCli=mysqli_query($con,$queryCli);
$rowCli=mysqli_fetch_assoc($resCli);

$idVenta= mysqli_real_escape_string($con,$_REQUEST['idVenta']??'');
$queryVenta="SELECT v.id,v.fecha
FROM ventas AS v
WHERE v.id = '$idVenta';";
$resVenta=mysqli_query($con,$queryVenta);
$rowVenta=mysqli_fetch_assoc($resVenta);
?>
<div>
    <img src="admin/images/pn.png" style="width: 30px;" >
    My eccomerce
</div>

<table style="width: 750px;margin-top: 20px;">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Recibe</th>
            <th>Datos de la factura</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <strong>Nombre:</strong><?php echo $rowCli['nombre'] ?><br>
                <strong>Email:</strong><?php echo $rowCli['email'] ?><br>
                <strong>Direccion:</strong><?php echo $rowCli['direccion'] ?><br>
            </td>
            <td>
                <strong>Nombre:</strong><?php echo $rowRecibe['nombre'] ?><br>
                <strong>Email:</strong><?php echo $rowRecibe['email'] ?><br>
                <strong>Direccion:</strong><?php echo $rowRecibe['direccion'] ?><br>
            </td>
            <td>
                <strong>Nombre:</strong><?php echo $rowVenta['id'] ?><br>
                <strong>Email:</strong><?php echo $rowVenta['fecha'] ?><br>
            </td>
        </tr>
    </tbody>
</table>