<?php
use MyApp\data\Database;
require("../../../vendor/autoload.php");
$db = new Database;

if($_GET['id']){
    $categoria=$_GET['categoria'];
    $id=$_GET['id'];
}
// VALIDAR SI LA CATEGORIA INGRESADA YA EXISTE
$validacionQry="SELECT * from categorias where nom_cat='$categoria'";
$validacion=$db->seleccionarDatos($validacionQry);

if(!empty($validacion)){

    header("Location:/src/views/admin/html/NomCat.php?mensaje=failed&cat=$categoria&id=$id");
}
else{
$updateQry="UPDATE `categorias` SET `nom_cat`='$categoria' WHERE `id_cat`=$id";
$update=$db->ejecutarConsulta($updateQry);
header("Location:/src/views/admin/html/NomCat.php?mensaje=success&cat=$categoria&id=$id");
}
