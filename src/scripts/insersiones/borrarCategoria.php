<?php
use MyApp\data\Database;
require("../../../vendor/autoload.php");
$db = new Database;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>Operacion Exitosa!</title>
  </head>
  <body class="">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
    <?php

//falta añadir campo imagen a universo para insertar la imagen
if($_GET['id']){
$categoria=$_GET['id'];

//Validar si hay productos con ese universo
$ValidarCategoriaQry="SELECT productos.id_producto, productos.nom_producto 
from productos join categorias on productos.id_cat = categorias.id_cat where categorias.id_cat = $categoria";
$ValidarCategoria=$db->seleccionarDatos($ValidarCategoriaQry);

if(empty($ValidarCategoria)){
  $deleteCategoriaQry= "DELETE FROM `categorias` WHERE `id_cat`='$categoria'";
  $deleteCategoria=$db->ejecutarConsulta($deleteCategoriaQry);
  
  header("Location:/src/views/admin/html/editCategoria.php");
}
else{
  echo " <div class='container mt-5'>
  <div class='alert alert-success' role='alert'>
    <div class='row'>
    <h1 class='alert-heading col-12' align='center'>No se puede eliminar esta categoria!</h1><br>
    <center><p>Aun hay productos con este categoria, elimina esos productos primero para poder eliminar el categoria</p></center>
    </div>";
    header("refresh:5;url=/src/views/admin/html/editCategoria.php");
 
}
}
?>
  </body>
</html>

