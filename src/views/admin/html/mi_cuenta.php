<?php
    use MyApp\data\Database;
    require("../../../../vendor/autoload.php");
    $db = new Database;

//ocultar warnings
error_reporting(E_ERROR | E_PARSE);



    
//Actualizar o subir foto de perfil
if(isset($_POST['subir_imagen'])){
  // Verificar si se ha seleccionado una nueva imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
      $imagen_nombre = $_FILES['imagen']['name'];
      $imagen_temporal = $_FILES['imagen']['tmp_name'];
      $id_usuario = $_POST['id_usuario'];


      // Directorio donde deseas guardar las imágenes
      $directorio_destino = "img_profile/"; // Cambia esto a la ruta correcta

      // Ruta completa del archivo de destino
      $ruta_destino = $directorio_destino.$imagen_nombre;

      

      //Borrar imagen actual del usuario para poner una nueva
      $imagen=$db->seleccionarDatos("SELECT imagen FROM `usuarios` where id_usuario=41");
      //borrar la imagen temporal (de la carpeta)
      foreach($imagen as $img){
          $image=$img['imagen'];
      }
      unlink("img_profile/".$image);





      // Mover la imagen al directorio de destino
      if (move_uploaded_file($imagen_temporal, $ruta_destino)) {
          // Configurar la conexión PDO (debes llenar los detalles de conexión)
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "geekhaven";

          try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              // Preparar la consulta SQL para actualizar la imagen en la base de datos
              $sql = "UPDATE usuarios SET imagen = :imagen WHERE id_usuario = :id_usuario";

              // Preparar la consulta usando PDO
              $stmt = $conn->prepare($sql);

              // Vincular los valores a los marcadores de posición
              $stmt->bindParam(':imagen', $imagen_nombre, PDO::PARAM_STR);
              $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

              // Ejecutar la consulta
              if ($stmt->execute()) {

              } else {
                  echo "Error al actualizar la imagen en la base de datos: " . $stmt->errorInfo()[2];
              }
          } catch (PDOException $e) {
              echo "Error de base de datos: " . $e->getMessage();
          }

          // Cerrar la conexión
          $conn = null;
      } else {
          echo "Error al mover la imagen al directorio de destino.";
      }
  } else {
      echo "Error al subir la nueva imagen.";
  }

}

    
//Actualizar datos personales
if(isset($_POST['guardar_datos_personales'])){

  $nombre_nuevo=$_POST['nombre'];
  $apellido_nuevo=$_POST['apellido'];
  $correo_nuevo=$_POST['correo'];

      //Actualizar nombre
      $update_nombre_nuveo = "UPDATE personas 
      INNER JOIN usuarios ON usuarios.id_persona = personas.id_persona
      SET personas.nombre = '$nombre_nuevo' 
      WHERE usuarios.id_usuario=41 and usuarios.tipo_usuario=0 ";
      $update_nombre=$db->ejecutarConsulta($update_nombre_nuveo);

      //Actualizar apellido
      $update_apellido_nuveo = "UPDATE personas 
      INNER JOIN usuarios ON usuarios.id_persona = personas.id_persona
      SET personas.apellido = '$apellido_nuevo' 
      WHERE usuarios.id_usuario=41 and usuarios.tipo_usuario=0";
      $update_apellido=$db->ejecutarConsulta($update_apellido_nuveo);

      //Actualizar correo
      $update_correo_nuveo = "UPDATE personas 
      INNER JOIN usuarios ON usuarios.id_persona = personas.id_persona
      SET personas.correo = '$correo_nuevo' 
      WHERE usuarios.id_usuario=41 and usuarios.tipo_usuario=0 ";
      $update_correo=$db->ejecutarConsulta($update_correo_nuveo);

}


$sql="SELECT * FROM personas INNER JOIN usuarios on personas.id_persona=usuarios.id_persona WHERE usuarios.tipo_usuario=0 and usuarios.id_usuario=41";

$datos_admin=$db->seleccionarDatos($sql);
foreach($datos_admin as $datos_admin){
$nombre=$datos_admin['nombre'];
$apellido=$datos_admin['apellido'];
$info=$datos_admin['info'];
$tipo_usuario=$datos_admin['tipo_usuario'];
$correo=$datos_admin['correo'];
$img=$datos_admin['imagen'];
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<style>
    input[type="file"] {
    display: none;
}
.imagen-preview {
    margin: auto;
    max-width: 60px; /* Cambiamos max-width a 60px */
    max-height: 60px; /* Cambiamos max-height a 60px */
    width: 60px; /* Usamos width al 100% para que la imagen se ajuste al contenedor */
    height: 60px; /* Usamos height al 100% para que la imagen se ajuste al contenedor */
    border-radius: 50%;
    border: 0px solid #0d6efd;
    position: relative;
    top: 0px;
    background-color: #2787f552;
    object-fit: cover; /* Añadimos object-fit para que la imagen se ajuste correctamente */
}

.imagen-preview img {
  margin: auto;
  max-width: 100%;
  max-height: 100%;
  width: 75px;
  height: 75px;
  border-radius:50%;
}
  /*Lista de chats/*/
  .chat-container {
    display: flex;
    width: 100%;
    padding-left:  0px;
    padding-right: 0px;
    padding-top: 18px;
    padding-bottom: 18px;
}
.profile-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
}
.chat-content {
    flex: 1;
}
.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
  /*Lista de chats/*/
</style>

<body>

<?php include('navbar.php') ?>

<!--  Header End -->
   <div class="container-fluid">
        <div class="container-fluid">
          <div class="" style="padding:20px">
          
          <div style="padding:0px">



  
    <h1 id="chats">Configuración</h1>
<br>
    <div>
        <div id="back_form"  class="chat-container" >
    <!-- Formulario para seleccionar y cargar una imagen -->
    <form action="" method="post" enctype="multipart/form-data" style="display:contents;margin-top: 0;">
        <input for="imagen" type="file" id="imagen" name="imagen" accept="image/*" onchange="mostrarImagen(event)" class="input-image">
        <input type="hidden" name="id_usuario" value="41">
    
    <!-- Vista previa de la imagen -->
    <style>
.feather-image {
  display: inline-block; /* Mostrar SVG por defecto */
}
</style>

<label for="imagen" class="label-imagen">
  <div id="imagen-preview" class="imagen-preview">
    <img  id="imagen-preview" src="img_profile/<?php echo $img;?>" onerror="this.style.display='none';" onload="">
    <center>
      <label for="imagen" class="label-imagen">
        <svg style="position:relative; top:-13px; left:-20px; margin:auto; background:#2787f552; border-radius:50%; padding:5%"  xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#0d6efd" class="bi bi-cloud-plus" viewBox="0 0 16 16"  stroke="##0d6efd" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
  <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
  <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
</svg>
    </center>
  </div>
</label>


    <script>
        function mostrarImagen(event) {
            const input = event.target;
            const preview = document.getElementById('imagen-preview');
            const guardarImagen = document.getElementById('guardarImagen');

            const reader = new FileReader();

            reader.onload = function() {
                const imagen = document.createElement('img');
                imagen.src = reader.result;
                preview.innerHTML = '';
                preview.appendChild(imagen);

                // Mostrar el botón para guardar imagen
                guardarImagen.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>


    
&ensp;&ensp;
            <div class="chat-content text-truncate">
                <div class="chat-header">
                    <h4 class="text-truncate" id="nombrechat"><?php echo $nombre . ' '. $apellido ?></h4>
                  
                </div>
                <div class="text-truncate" id="mensajechat" >
                  <?php if($tipo_usuario==0){
                    echo "Administrador";
                  } ?>
                </div>
                <br> 
       <!-- Botón para guardar imagen (inicialmente oculto) -->
       <button type="submit" id="guardarImagen" style="display: none; margin-left: 0%; border:none; border-radius:10px; background-color: #0071e3; color: white; padding: 10px 25px;" name="subir_imagen">Guardar Imagen</button>
       </form>
            </div>


            <br><br>
        </div>
        


                  <form action="" method="POST">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nombre</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" aria-describedby="emailHelp" value="<?php echo $nombre ?>">
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Apellidos</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="apellido" value="<?php echo $apellido ?>">
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Correo Electronico></label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="correo" value="<?php echo $correo ?>">
                    </div>

                    <fieldset disabled>
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Tipo de usuario</label>
                        <input type="text" id="disabledTextInput" class="form-control" placeholder=" <?php if($tipo_usuario==0){
                    echo "Administrador";
                  } ?>">
                      </div>

                    </fieldset>

                    <br>
                    
                   <center> <button type="submit" name="guardar_datos_personales"  class="btn btn-primary">Guardar Cambios</button></center>
                  </form>
                </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>