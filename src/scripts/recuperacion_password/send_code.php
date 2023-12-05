<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




use MyApp\data\Database;
            require("../../../vendor/autoload.php");
            $db = new Database();

            // Obtener los valores del formulario

$correo = $_POST['email'];

if(isset($correo)){
    $sql="Select * from personas inner join usuarios on usuarios.id_persona = personas.id_persona where personas.correo='$correo'";
    $datos=$db->seleccionarDatos($sql);

 

    if(!empty($datos)){
        //generar codigo y guardarlo en la base de datos
        $codigo_verificacion = mt_rand(100000, 999999);

        //sacar el id_persona en relacion al correo electronico y el nombre
        foreach($datos as $id_persona){
            $id= $id_persona['id_persona']; 
            $nombre=$id_persona['nombre'];
       
        //insertar el codigo de verificacion en la base de datos
        $sql = "UPDATE usuarios
        SET codigo_reset_passwd = $codigo_verificacion
        WHERE id_persona=$id";

        $insert_codigo_verificacion=$db->ejecutarConsulta($sql);
        header("Location: insert_code.php?id=$id");

        }




        //Enviar Correo con codigo de verificacion

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'geekhaven.soporte@gmail.com';                     //SMTP username
    $mail->Password   = 'kuyrbsyukrmwbbpw';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('geekhaven.soporte@gmail.com', 'Geekhaven');
    $mail->addAddress($correo, 'Angel');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Codigo de verificacion para restablecer contraseña de  Geekhaven';
    $mail->Body    ='
    <!DOCTYPE html>
<html lang="en" style="background-color: white;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Boostrap-->   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <!--Boostrap--> 
</head>

<body style="background-color: white;">


            
   <div  style="margin:2%; margin-top:-30px; background:none">

    <p style="margin-bottom:20px; opacity:0.8">Hola, ' . $nombre. ':</p>
    <p style="margin-bottom:20px; opacity:0.8">Recibimos una solicitud para restablecer tu contraseña de Geekhaven.
Ingresa el siguiente código para restablecer la contraseña:</p>

<div style="background:#e7f3ff; border: 1px solid #1877f2; border-radius:10px; width:200px; padding:3px">
<center><p style="font-size:20px; color:black; font-weight:700; position:relative; top:8px">' . $codigo_verificacion . '</p></center>
</div>

<br><br>
<hr style="opacity:0.1">

<center><p style="color:#939393">from</p></center>

<center>
<img width="20" height="20" src="https://img.icons8.com/ios-glyphs/30/0d6efd/approval.png" alt="approval"/>&ensp; <b style="margin-top:5px">Geekhaven</b>
</center>
<br>

<div style="width:80%; margin-left:10%; margin-right:10%; text-align:center">
<p style="font-size:14px"">Este mensaje se envió a <span style="color:#0d6efd">' . $correo . ' </span>
A fin de proteger tu cuenta, no reenvíes este correo electrónico. </p>
<br>
<br>
</div>


</div>


</body>
</html>
    ';

    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


    }
    
    
    else {
?>
<!DOCTYPE html>
<html lang="en" style="background-color: white;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Boostrap-->   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../views-index/estilos.css">
    <link rel="stylesheet" href="/src/views/admin/assets/css/styles.min.css" />
        <!--Boostrap--> 
</head>

<body style="background-color: white;">

<div class="todo">
      
<?php
include('../../../templates/navbar_user.php');
?>
            
        <br><br><br>

        <div class="container" style="padding-left: 10%; padding-right: 10%;">
        <center><h1 style="position:relative; margin-top:80px; font-weight:500; font-size:30px">Lo sentimos, ha habido un problema</h1></center>
        <div class="text-center alert alert-danger" role="alert" style="position:absolute; left:10%; top:35%; width:80%; padding:2%"> Este correo electronico no esta asociado a ninguna cuenta. </div>


<center>
        <div id="botonContainer" style="position:relative; padding-top:200px">
            <button type="submit" style="margin-left: -7%; border:none; border-radius:15px; background-color: #0071e3; color: white; padding: 10px 25px; " name="crearchatphone" onclick="goBack()">Volver</button>
        </div>
    </center>

    <script>

        // Función JavaScript para regresar
        function goBack() {
            window.history.back();
        }
    </script>
        
        </div>

        </div>

        <script src="../../../bootstrap/js/transiciondeentrada.js"></script>
        <script src="/src/views/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/src/views/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/src/views/admin/assets/js/sidebarmenu.js"></script>
  <script src="/src/views/admin/assets/js/app.min.js"></script>
  <script src="/src/views/admin/assets/libs/simplebar/dist/simplebar.js"></script>

</body>
</html>

 <?php       
    }
}




?>