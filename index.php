<?php
    use MyApp\data\Database;
    require("vendor/autoload.php");
    $db = new Database;
    $db1 = new Database;

    $HOST=$_SERVER['SERVER_NAME'];
  
    
    //ocultar warnings

    $resultado = "select * from usuarios";
   
//extraer datos del formulario
    

    //Favoritos del mes    
    $sql = "SELECT p.id_producto as 'id_producto', p.nom_producto as 'nombre', p.precio as 'precio', c.nom_cat as 'categoria', COUNT(*) as cantidad_vendida
    FROM detalle_orden as do
    INNER JOIN productos p ON do.id_producto = p.id_producto
    INNER join categorias c on c.id_cat=p.id_cat
    WHERE MONTH(do.fecha_detalle) = MONTH(CURRENT_DATE) and existencia>0 
    GROUP BY do.id_producto, p.nom_producto
    ORDER BY cantidad_vendida DESC limit 6;";
    $favoritos_del_mes=$db->seleccionarDatos($sql);


    //ofertas
    $sql="SELECT * from productos INNER JOIN categorias on categorias.id_cat=productos.id_cat WHERE productos.estado='oferta' AND existencia>0;";
    $ofertas=$db->seleccionarDatos($sql);


    //Recien llegados
    $sql="SELECT * FROM productos inner join categorias on categorias.id_cat=productos.id_cat where existencia>0  ORDER BY fecha desc LIMIT 6;";
    $recien_llegados=$db->seleccionarDatos($sql);
  
    //Categorias
    $sql = "SELECT * from categorias";
    $categorias=$db->seleccionarDatos($sql);
  
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Geek Haven</title>
  <link rel="stylesheet" href="/src/views/admin/assets/css/styles.min.css" />
  <link rel="stylesheet" href="/bootstrap/css/estilos.css" />
  
</head>


<body>

<?php include('templates/navbar_user.php'); ?>


      <div class="container-fluid">
       
<div class="scroll-appear">





      <h1 class="text-center" style="font-weight: 600;color: #000; font-size: 36px;">
      Geek Hasta el final, ¡Game Over!
              </h1>
        
        <br>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
        
        <div id="carouselExampleDark" class="carousel carousel-light slide" >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img style="border-radius:25px;     width: 100% !important;" src="https://cdn.pixabay.com/photo/2021/09/07/07/11/joysticks-6603119_1280.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 style="color:white"; >Bienvenido a GeekHaven</h5>
        <p>Diseñado por Geeks, para Geeks. Descubre Nuestra Colección Excepcional de Productos Tecnológicos y Artículos de Colección.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img style="border-radius:25px;     width: 100% !important;" src="https://cdn.pixabay.com/photo/2021/10/07/20/46/playstation-6689793_1280.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5  style="color:white";>GeekHaven</h5>
        <p>Tu Espacio de Compras Exclusivo para Geeks, donde la Innovación es la Norma.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img style="border-radius:25px;     width: 100% !important;" src="https://cdn.pixabay.com/photo/2016/11/02/14/15/x-box-1791676_1280.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5  style="color:white";>Convierte tu Pasión en Realidad</h5>
        <p>GeekHaven te Ofrece una Experiencia de Compra Geek Inigualable, incluyendo Videojuegos.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</div>

<br><br>



<div class="scroll-appear">
<h3>Categorias Principales</h3>
<br>


<?php include 'templates/carrousel.html'; ?>
<br><br><br>





<div class="scroll-appear">
<div class="container">
  
<section id="shopify-section-template--16720316268796__d094902d-6b1f-4787-b493-b2a861dfc204" class="shopify-section shopify-section--image-with-text-overlay"><style>
      #shopify-section-template--16720316268796__d094902d-6b1f-4787-b493-b2a861dfc204 {--section-outer-spacing-block: 0;--content-over-media-overlay: 0 0 0 / 0.0;}
    </style>

    <div class="section   section-blends section-full text-custom" style="--text-color: 255 255 255;"><image-banner  reveal-on-scroll="true" class="content-over-media content-over-media--auto full-bleed  text-custom" style="--text-color: 255 255 255; opacity: 1;"><img style="width:98%; height:10%; border-radius:20px" src="//www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1920" alt="" srcset="//www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=200 200w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=300 300w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=400 400w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=500 500w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=600 600w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=700 700w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=800 800w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=900 900w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1000 1000w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1200 1200w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1400 1400w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1600 1600w, //www.gamerpoint.com.mx/cdn/shop/files/favoritos_del_mes_2.png?v=1692920156&amp;width=1800 1800w" width="1920" height="500" loading="lazy" sizes="100vw" class=""><div class="place-self-center text-center sm:place-self-center sm:text-center">
            <div class="prose"></div>
          </div></image-banner>
    </div>
</section>
</div>
<br><br>
</div>

</div>



<div class="container" style="margin-left:15px">
<div class="scroll-appear">
<div class="row">
<?php
foreach ($favoritos_del_mes as $fav_del_mes) {
    $id_producto_fav = $fav_del_mes['id_producto'];
    $sacarImgQry_fav = "SELECT * FROM productos INNER JOIN img_productos ON img_productos.id_producto = productos.id_producto WHERE productos.id_producto = $id_producto_fav and productos.existencia > 0";
    $sacarImg_fav = $db1->seleccionarDatos($sacarImgQry_fav);

?>

<div class="col-sm-6 col-xl-3">
    <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
            <a href="\src\views\user\productos.php?id=<?php echo $fav_del_mes['id_producto']; ?>">
                <?php
                foreach ($sacarImg_fav as $img_f) 
		$img_fa = $img_f['nombre_imagen'];
                if (!empty($img_fa)) {
                    
                        echo '<img src="/src/views/admin/html/img_producto/' . $img_fa . '" class="d-block w-100" height="310px" alt="...">';
                    }
                    else {
                      // Mostrar imagen por default si no hay imágenes asociadas
                      echo '<img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" class="d-block w-100" height="310px" alt="Imagen por default">';
                  }
                
                ?>
            </a>

            <a href="/src\views\user\productos.php?id=<?php echo $fav_del_mes['id_producto']; ?>" class="bg-success rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                </svg>
            </a>
        </div>

        <div class="card-body pt-3 p-4">
            <div style="width:100%;">
                <h6 class="fw-semibold fs-4 text-truncate"><?php echo $fav_del_mes['nombre']; ?> </h6>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0"><?php echo '$' . $fav_del_mes['precio']; ?></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <?php echo $fav_del_mes['categoria']; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
}
?>

</div>
</div>


<div class="scroll-appear">
<br><br>
<div class="container" style="margin-left:-10px">
<div class="section   section-blends section-full text-custom" style="--text-color: 255 255 255;"><image-banner reveal-on-scroll="true" class="content-over-media content-over-media--auto full-bleed  text-custom" style="--text-color: 255 255 255; opacity: 1;"><img style="width:98%; height:10%; border-radius:20px" src="//www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1920" alt="" srcset="//www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=200 200w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=300 300w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=400 400w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=500 500w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=600 600w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=700 700w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=800 800w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=900 900w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1000 1000w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1200 1200w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1400 1400w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1600 1600w, //www.gamerpoint.com.mx/cdn/shop/files/NUESTRAS_OFERTAS.png?v=1692920909&amp;width=1800 1800w" width="1920" height="500" loading="lazy" sizes="100vw" class=""><div class="place-self-center text-center sm:place-self-center sm:text-center">
        <div class="prose"></div>
      </div></image-banner>
</div>
</div>
<br><br>
</div>


<div class="scroll-appear">
<div class="row">
<?php
foreach ($ofertas as $oferta) {
    $id_producto_oferta = $oferta['id_producto'];
    $sacarImgQry_oferta = "SELECT * FROM productos INNER JOIN img_productos ON img_productos.id_producto = productos.id_producto WHERE productos.id_producto = $id_producto_oferta and productos.existencia>0 ";
    $sacarImg_oferta = $db1->seleccionarDatos($sacarImgQry_oferta);
?>

<div class="col-sm-6 col-xl-3">
    <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
            <a href="<?php echo '/src/views/user/productos.php?id=' . $oferta['id_producto']; ?>">
                <?php
                 foreach ($sacarImg_oferta as $img_of)

                 $imagen_off = $img_of['nombre_imagen'];
                if (!empty($imagen_off)) {
                    // Si hay imágenes disponibles, mostrar la primera
                    echo '<img src="/src/views/admin/html/img_producto/' . $imagen_off. '" class="img-fluid" style="max-width: 100%; height: 310px;" alt="...">';
                  } else {
                    // Mostrar imagen por default si no hay imágenes asociadas
                    echo '<img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" class="d-block w-100" height="310px" alt="Imagen por default">';
                }
                ?>
            </a>

            <a href="<?php echo '/src/views/user/productos.php?id=' . $oferta['id_producto']; ?>" class="bg-success rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                </svg>
            </a>
        </div>

        <div class="card-body pt-3 p-4">
            <div style="width:100%;">
                <h6 class="fw-semibold fs-4 text-truncate"><?php echo $oferta['nom_producto']; ?> </h6>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0"><?php echo '$' . $oferta['precio']; ?></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <?php echo $oferta['nom_cat']; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
}
?>


</div>
</div>




<div class="scroll-appear">
<br><br>
<div class="container"  style="margin-left:-10px">
<div class="section   section-blends section-full text-custom" style="--text-color: 255 255 255;"><image-banner reveal-on-scroll="true" class="content-over-media content-over-media--auto full-bleed  text-custom" style="--text-color: 255 255 255; opacity: 1;"><img style="width:98%; height:10%;border-radius:20px" src="//www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1920" alt="" srcset="//www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=200 200w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=300 300w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=400 400w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=500 500w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=600 600w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=700 700w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=800 800w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=900 900w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1000 1000w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1200 1200w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1400 1400w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1600 1600w, //www.gamerpoint.com.mx/cdn/shop/files/RECIEN_LLEGADOS.png?v=1692920978&amp;width=1800 1800w" width="1920" height="500" loading="lazy" sizes="100vw" class=""><div class="place-self-center text-center sm:place-self-center sm:text-center">
        <div class="prose"></div>
      </div></image-banner>
</div>
</div>
<br><br>
</div>


<div class="scroll-appear">
<div class="row">
<?php
foreach ($recien_llegados as $producto_recien_llegado) {
    $id_producto_recien_llegado = $producto_recien_llegado['id_producto'];
    $sacarImgQry_recien_llegado = "SELECT * FROM productos INNER JOIN img_productos ON img_productos.id_producto = productos.id_producto WHERE productos.id_producto = $id_producto_recien_llegado";
    $sacarImg_recien_llegado = $db1->seleccionarDatos($sacarImgQry_recien_llegado);
?>

<div class="col-sm-6 col-xl-3">
    <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
            <a href="/src/views/user/productos.php?id=<?php echo $producto_recien_llegado['id_producto']; ?>">
                <?php
                $imagen_defecto_mostrada = false; // Variable para rastrear si ya se mostró la imagen por defecto
                foreach ($sacarImg_recien_llegado as $img_recien_llegado) {
                    if (!empty($img_recien_llegado['nombre_imagen'])) {
                        echo '<img src="/src/views/admin/html/img_producto/' . $img_recien_llegado['nombre_imagen'] . '" class="d-block w-100" height="310px" alt="...">';
                        $imagen_defecto_mostrada = true; // Hay una imagen, no necesitamos mostrar la imagen por defecto
                        break; // Salimos del bucle, ya que ya se encontró una imagen
                    }
                }

                if (!$imagen_defecto_mostrada) {
                    // Mostrar imagen por defecto si no se encontró ninguna imagen
                    echo '<img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" class="d-block w-100" height="310px" alt="Imagen por default">';
                }
                ?>
            </a>

            <a href="/src/views/user/productos.php?id=<?php echo $producto_recien_llegado['id_producto']; ?>" class="bg-success rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                </svg>
            </a>
        </div>

        <div class="card-body pt-3 p-4">
            <div style="width:100%;">
                <h6 class="fw-semibold fs-4 text-truncate"><?php echo $producto_recien_llegado['nom_producto']; ?> </h6>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0"><?php echo '$' . $producto_recien_llegado['precio']; ?></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <?php echo $producto_recien_llegado['nom_cat']; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
}
?>

</div>
</div>


</div>



<br><br><br>
<center><h2>Universos</h2></center>
<br><br>

<div class="container">
<div class="scroll-appear">
<div class="row">

  <?php
  $universoQry="SELECT * FROM `universo` where universo.universo != 'Sin universo'";
  $universo=$db->seleccionarDatos($universoQry);
  foreach($universo as $res){
    $img=$res['img'];
  ?>
  <div class="col-12 col-md-6 text-center" style="margin-bottom:30px">
  <a href="/src/views/user/universo.php?id=<?php echo $res['id_universo']?>">
  <article class="card card--1" style="margin-left:20px">

<div class="card__info">
<img width="210" height="210" src="/src/scripts/insersiones/<?php echo $res['img']?>" >
  <h3 class="card__title"><?php echo $res['universo'];?></h3>

</div>
</article>
  </a>

  </div>
  <?php
  echo ""; }
  ?>

  
  </div>

  </div>


<br><br>
<hr>
<br><br>


<div>
<div class="scroll-appear">
    <div class="row">
        <div class="col-sm-12 col-lg-4 left">
        <h2>Nosotros</h2>
            <p class="card_category" style ="text-align: justify;">En nuestra tienda, encontrarás una cuidadosa selección de productos de alta calidad y ediciones especiales que se adaptan a tus intereses y gustos únicos. Ya seas un fanático de las historias de superhéroes, un ávido jugador de videojuegos o un coleccionista de figuras raras, estamos aquí para satisfacer tus necesidades.</p>
            <br>
            <h2>Nuestra misión</h2>
            <p class="card_category text-justify" style ="text-align: justify;">Somos una tienda creada con pasión por y para los coleccionistas y entusiastas del mundo geek, friki y gamer. Nos apasiona proporcionar un espacio donde puedas encontrar una amplia variedad de artículos coleccionables, desde cómics y mangas hasta videojuegos y juegos de mesa. Nuestra misión es hacer que la obtención de tus artículos favoritos sea fácil y emocionante.</p>
        </div>
    <br>
        <div class="col-sm-12 col-lg-7 text-center">
        <h1>Nuestra ubicacion</h1>
          <p class="card__category" > Calle Muñoz Campos #698-A Col.La Amistad</p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.605619453558!2d-103.3643797239029!3d25.551510617257275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdb32fdffc36f%3A0x73181d7959ea4557!2sC.%20Mu%C3%B1oz%20Campos%2C%2027054%20Torre%C3%B3n%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1700536411832!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    
      </div>

      </div>
</div>


</div>

<script src="/src/views/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/src/views/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/src/views/admin/assets/js/sidebarmenu.js"></script>
  <script src="/src/views/admin/assets/js/app.min.js"></script>
  <script src="/src/views/admin/assets/libs/simplebar/dist/simplebar.js"></script>



  <script>
document.addEventListener("DOMContentLoaded", function () {
  const scrollAppearElements = document.querySelectorAll(".scroll-appear");

  const options = {
    root: null, // viewport
    rootMargin: "0px",
    threshold: 0,
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("appear");
      } else {
        entry.target.classList.remove("appear");
      }
    });
  }, options);

  scrollAppearElements.forEach((element) => {
    observer.observe(element);
  });
});
</script>




</body>

</html>
