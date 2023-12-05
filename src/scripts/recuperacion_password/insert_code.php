
<?php
    use MyApp\data\Database;
    require("../../../vendor/autoload.php");
    $db = new Database;

if(isset($_GET['id']))

$id=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en" style="background-color:  #fff;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión</title>
    <link rel="icon" href="../img/logo .png">

    <!--Boostrap-->   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../../views-index/estilos.css">
<link rel="stylesheet" href="/src/views/admin/assets/css/styles.min.css" />
    <!--Boostrap--> 
</head>


<style>
  .notification {
            background-color: #f44336;
            color: white;
            text-align: center;
            padding: 20px;
            padding-bottom:3px;
          margin-top:-50px;
            border-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .close-button {
            float: right;
            font-weight: bold;
            cursor: pointer;
        }
</style>

<body >
<div class="todo">

<?php
include('../../../templates/navbar_user.php');
?>



          <!--Logo y login-->
                <div class="container">
                    <div style=" padding: 3%; padding-top: 3%;">
                    <br><br><br>

            <center>
            <svg style="width:80;" xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="black" class="bi bi-joystick" viewBox="0 0 16 16">
              <path d="M10 2a2 2 0 0 1-1.5 1.937v5.087c.863.083 1.5.377 1.5.726 0 .414-.895.75-2 .75s-2-.336-2-.75c0-.35.637-.643 1.5-.726V3.937A2 2 0 1 1 10 2z"></path>
              <path d="M0 9.665v1.717a1 1 0 0 0 .553.894l6.553 3.277a2 2 0 0 0 1.788 0l6.553-3.277a1 1 0 0 0 .553-.894V9.665c0-.1-.06-.19-.152-.23L9.5 6.715v.993l5.227 2.178a.125.125 0 0 1 .001.23l-5.94 2.546a2 2 0 0 1-1.576 0l-5.94-2.546a.125.125 0 0 1 .001-.23L6.5 7.708l-.013-.988L.152 9.435a.25.25 0 0 0-.152.23z"></path>
            </svg>
            </center>
            <br><br>


      
                    </div>
                  
                    
                    <!--FORM-->
                    <div  style="margin-top:-5%;">
                        <h1 style="font-size: 35px; color: rgb(73, 73, 73);; font-style: inherit;" class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg> Codigo enviado correctamente</h1>
                        <p style="font-size: 18px; font-weight: 300; " class="text-center">Ingresa tu codigo de verificacion</p>
                       

                        <div class="col-11 col-md-8 col-lg-6"  style="margin: auto;">



                        
                            <form action="verificacion_code.php?id=<?php echo $id ?>" method="post">
                                    <div class="form-floating">
                                        <input style="width:100%; margin:auto; background-color:#f5f5f5a8; color: #848484; margin-bottom:1.5%;  border:0px; border-radius:10px; height:8%;" class="form-control input" type="number" id="codigo" name="codigo" maxlength="6"  required >
                                        <script>
    function validarNumero(input) {
        // Elimina cualquier carácter que no sea un número
        input.value = input.value.replace(/[^0-9]/g, '');

        // Limita la longitud a 5 dígitos
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
</script>
                                        <label for="floatingInput">Codigo de verificación &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                                        </label> 
                                    </div>
                                   <center> <a href="/src/views/user/olvido.php" style="color:#0d6efd">¿No recibiste el código?</a>   </center>                                                
<br><br>

                                <center>
                                    <button type="submit" style="margin-left: 5.5%; border:none; border-radius:15px; background-color: #0071e3; color: white; padding: 10px 25px; ">Comprobar</button>
                                    </center>

                               
                            </form>
                        </div>


                    </div>
                    <!--FORM-->

                </div>
                <!--Logo y login-->
                   <br><br> 



   </div>

   <script src="../../../bootstrap/js/transiciondeentrada.js"></script>
   <script src="/src/views/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/src/views/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/src/views/admin/assets/js/sidebarmenu.js"></script>
  <script src="/src/views/admin/assets/js/app.min.js"></script>
  <script src="/src/views/admin/assets/libs/simplebar/dist/simplebar.js"></script>
  
   </body>
   </html>
   

