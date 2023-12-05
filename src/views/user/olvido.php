<?php
use MyApp\data\Database;
require("../../../vendor/autoload.php");
$db = new Database();


$sql = "SELECT * from categorias";

$categorias=$db->seleccionarDatos($sql);


?>
<!doctype html>
<html lang="en">

<head>
  <title>Olvide mi contraseña</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="/src/views/admin/assets/css/styles.min.css" />
  <link rel="stylesheet" href="/bootstrap/css/estilos.css" />
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

</head>

<body>
<?php
include('../../../templates/navbar_user.php');
?>

  <style>

            a{
            color: #333;
            }
            a:hover {
              color: #FF0000; /* Rojo (#FF0000) cuando se pasa el mouse */
            }
        .formulario {
         
            padding: 10px;
            border-radius: 10px;
            max-width: 400px;
            max-height: ;
            margin: 0 auto;
        }

            #nombre {
                margin-right: 10px; /* Agrega espacio a la derecha del campo "nombre" */
            }

            #apellidos {
                margin-left: 10px; /* Agrega espacio a la izquierda del campo "apellidos" */
            }

        .form-group-horizontal {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>





<div class="container-fluid">
       



    <div class="container mt-5">
        <div class="formulario">
            <br><br>
            <center><h2><strong>Recupera tu contraseña</strong></h2></center><br>
            <p>Ingresa tu correo para enviar un código de recuperación.</p>
            <br>
            <form action="/src/scripts/recuperacion_password/send_code.php" method="post"> 
                <div class="mb-3">
                    <input type="email" style="width:100%; margin:auto; background-color:#f5f5f5a8; color: #848484; margin-bottom:1.5%;  border:0px; border-radius:10px; height:50px;" class="form-control" id="correo" name="email" placeholder="Correo electrónico" required pattern=".+@(gmail\.com|outlook\.com|yahoo\.com|icloud\.com|yandex\.com)$" title="Por favor, introduce un correo válido con alguno de los dominios: gmail.com, outlook.com, yahoo.com, icloud.com, yandex.com">
                
                  </div>
                    <br>               
                    <center>  <button type="submit" class="btn text-white btn-lg" style="width: 100%; background:#005aff; color:white">Confirmar</button></center>
                        <br>
                       <center> <a href="login.php" style="color:red">Volver al inicio de Sesion</a></center>
          </form>
        </div>
      </div>








</div>



<script src="/src/views/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/src/views/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/src/views/admin/assets/js/sidebarmenu.js"></script>
  <script src="/src/views/admin/assets/js/app.min.js"></script>
  <script src="/src/views/admin/assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>