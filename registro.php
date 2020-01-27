<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My ecommerce</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>My</b>ecommerce
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Registrate</p>
                <?php
                if (isset($_REQUEST['registro'])) {
                    session_start();
                    $email = $_REQUEST['email'] ?? '';
                    $nombre = $_REQUEST['nombre'] ?? '';
                    $pasword = $_REQUEST['pass'] ?? '';
                    $pasword = md5($pasword);
                    include_once "admin/db_ecommerce.php";
                    $con = mysqli_connect($host, $user, $pass, $db);
                    $query = "INSERT into clientes (nombre,email,pass) values ('$nombre','$email','$pasword')";
                    $res = mysqli_query($con, $query);
                    if ($res) {
                    ?>
                        <div class="alert alert-primary" role="alert">
                            <strong>Registro exitosos</strong> <a href="login.php">Ir a login</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Error de registro
                        </div>
                <?php
                    }
                }
                ?>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="pass">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="registro">Registrarse</button>
                            <a href="login.php" class="text-success float-right">Ir a login</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="admin/dist/js/adminlte.min.js"></script>

</body>

</html>