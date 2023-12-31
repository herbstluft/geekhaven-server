<?php

ob_start();
session_start();
$_SESSION['user'];
$host=$_SERVER['SERVER_NAME'];
use MyApp\data\Database;
require(__DIR__ . '/../../../vendor/autoload.php');
$db = new Database;
$db1 = new Database;

//obtener el ID de la orden y del usuario
if ($_GET['id_orden']){
$id_orden=$_GET['id_orden'];
$usr=$_SESSION['user'];
}
//Sacar el precio total del pedido
$TotalPedidoQry="SELECT TRUNCATE(SUM(PRDT.precio * PRDT.cantidad),2) as TOTAL FROM (SELECT PRD.id_producto,PRD.nom_producto, PRD.precio,PRD.descripcion, usuarios.id_usuario as usr, detalle_orden.cantidad as cantidad, detalle_orden.estatus as stat FROM usuarios JOIN detalle_orden on usuarios.id_usuario=detalle_orden.id_usuario JOIN (SELECT * from productos) as PRD on PRD.id_producto = detalle_orden.id_producto WHERE usuarios.id_usuario = $usr and detalle_orden.estatus=1 and detalle_orden.id_orden=$id_orden) as PRDT;";
$Total=$db->seleccionarDatos($TotalPedidoQry);

//OBTENER los productos de la compra
$ProductosPedidoQry="SELECT PRD.id_producto,PRD.nom_producto, PRD.precio,PRD.descripcion, usuarios.id_usuario as usr, detalle_orden.cantidad as cantidad, detalle_orden.estatus as stat FROM usuarios JOIN detalle_orden on usuarios.id_usuario=detalle_orden.id_usuario JOIN (SELECT * from productos) as PRD on PRD.id_producto = detalle_orden.id_producto WHERE usuarios.id_usuario = $usr and detalle_orden.estatus=1 and detalle_orden.id_orden=$id_orden";

$ProductosPedido=$db->seleccionarDatos($ProductosPedidoQry);
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

  </head>
  <body>
    
    <div class="mx-auto  p-5" style="width:60%">
    <center>
    <svg style="width:80;" xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="black" class="bi bi-joystick" viewBox="0 0 16 16">
              <path d="M10 2a2 2 0 0 1-1.5 1.937v5.087c.863.083 1.5.377 1.5.726 0 .414-.895.75-2 .75s-2-.336-2-.75c0-.35.637-.643 1.5-.726V3.937A2 2 0 1 1 10 2z"></path>
              <path d="M0 9.665v1.717a1 1 0 0 0 .553.894l6.553 3.277a2 2 0 0 0 1.788 0l6.553-3.277a1 1 0 0 0 .553-.894V9.665c0-.1-.06-.19-.152-.23L9.5 6.715v.993l5.227 2.178a.125.125 0 0 1 .001.23l-5.94 2.546a2 2 0 0 1-1.576 0l-5.94-2.546a.125.125 0 0 1 .001-.23L6.5 7.708l-.013-.988L.152 9.435a.25.25 0 0 0-.152.23z"></path>
            </svg>
  <br>
            <b style="color: black; font-size:40px;" class="">GeekHaven</b>
            <br>
            <p style="color:grey;">Comercializadora GeekHaven S.A de C.V</p>
            <p style="color:grey;">RFC: GAHG231122ABC </p>
    </center>
            <br>
        <H1 align="center">INSTRUCCIONES</H1>
        
            <h3 align="center">Las instrucciones para recoger tu pedido son las siguientes:</h3>
            <ul>
                <li> Imprime este ticket que comprueba que ya finalizaste tu pedido</li>
                <li>Luego acude a la tienda en la direccion: Calle Muñoz Campos #698-A Col La Amistad CP: 27054</li>
                <li> Llega a caja enseñe su ticket de compra (la o el cajero revisara su ticket y le cobrara el total en pesos mexicanos)</li>
                <li> Una vez hecho el pago en efectivo o tarjeta se te entregara tu pedido.</li>
            </ul>
            <h4 align="center">Muchas gracias por comprar con nosotros!</h4>
    </div>
    <div class=" ">
        <h1 align="center" class="text-dark">PEDIDO</h1>
        <h2 align="center" class="text-danger">No° de pedido:<?php echo $id_orden;?></h2>
        <?php foreach($Total as $res){?>
        <h1 class="text-danger">Total: $<?php echo $res['TOTAL'];}?></h1>

        <div class="table-responsive">
        <table class="table table-striped">
  <thead>
    <tr class="">
      <th scope="col">SKU</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio unitario</th>
      <th scope="col">Precio Total</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($ProductosPedido as $res){
        $id_producto=$res['id_producto'];
        $TotalPrdQry="SELECT TRUNCATE(SUM(PRDT.precio * PRDT.cantidad),2) as TOTAL FROM (SELECT PRD.id_producto,PRD.nom_producto, PRD.precio,PRD.descripcion, usuarios.id_usuario as usr, detalle_orden.cantidad as cantidad, detalle_orden.estatus as stat FROM usuarios JOIN detalle_orden on usuarios.id_usuario=detalle_orden.id_usuario JOIN (SELECT * from productos) as PRD on PRD.id_producto = detalle_orden.id_producto WHERE usuarios.id_usuario = $usr and detalle_orden.estatus=1 and detalle_orden.id_orden=$id_orden) as PRDT 
        WHERE PRDT.id_producto =$id_producto";
        $totalPrd=$db->seleccionarDatos($TotalPrdQry);

    ?>
    
    <tr>
      <th scope="row" class="fs-5"><?php echo $res['id_producto']; ?></th>
      <td class="fs-5"><?php echo $res['nom_producto']; ?></td>
      <td align="center" class="fs-5"><?php echo $res['cantidad']; ?></td>
      <td align="center" class="fs-5"><?php echo '$'.$res['precio']; ?></td>
      <td align="center" class="fs-5"><?php foreach($totalPrd as $to){ echo '$'.$to['TOTAL'];}}?></td>
    </tr>
  </tbody>
</table>
        </div>
        

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
$html=ob_get_clean();
 require_once '../dompdf/autoload.inc.php';
                
 use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

// formato carta
$dompdf->setPaper('letter');
// formato horizontal
// $dompdf-setPaper('A4','Landscape');

$dompdf->render();

$dompdf->stream("ticket1.pdf",array("Attachment"=>true));

$HOST=$_SERVER['SERVER_NAME'];
header("refresh: 3; url=http://'.$HOST.'/var/www/geekhaven/");
?>
