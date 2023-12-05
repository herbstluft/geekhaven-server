<?php
session_start();
use MyApp\data\Database;
require("../../../vendor/autoload.php");
$db = new Database();

// Obtiene el id del usuario activo
if(isset($_SESSION['admin'])){
    $id = $_SESSION['admin'];
}
if(isset($_SESSION['user'])){
    $id = $_SESSION['user'];
}

// Datos de la publicación
if(isset($_SESSION['pub_id'])){
    // ... Tu lógica para manejar datos de publicación
}

$id_amigo = $_SESSION['id_friend'];

// Obtiene las imágenes de perfil
$sql = "SELECT usuarios.imagen as imagen_amigo FROM usuarios WHERE usuarios.id_usuario = :id_amigo";
$img_profile_friend = $db->seleccionarDatos($sql, array(':id_amigo' => $id_amigo));
$img_f = $img_profile_friend[0]['imagen_amigo'];

$sql = "SELECT usuarios.imagen as imagen_mia FROM usuarios WHERE usuarios.id_usuario = :id";
$img_profile_user = $db->seleccionarDatos($sql, array(':id' => $id));
$img_m = $img_profile_user[0]['imagen_mia'];

// Obtiene los mensajes
$sql = "SELECT PR.nombre as remitente, remitente.id_usuario as id_remitente,
               PD.nombre as destinatario, mensajes.mensaje, mensajes.fecha as Fecha
        FROM mensajes
        INNER JOIN usuarios as remitente ON remitente.id_usuario = mensajes.id_remitente 
        INNER JOIN usuarios as destinatario ON destinatario.id_usuario = mensajes.id_destinatario
        INNER JOIN personas as PD ON PD.id_persona = destinatario.id_persona
        INNER JOIN personas as PR ON PR.id_persona = remitente.id_persona
        INNER JOIN conversaciones ON conversaciones.id_conversacion = mensajes.id_conversacion
        WHERE (remitente.id_usuario = :id AND destinatario.id_usuario = :id_amigo AND conversaciones.id_pub = :pub_id) 
           OR (remitente.id_usuario = :id_amigo AND destinatario.id_usuario = :id AND conversaciones.id_pub = :pub_id)
        ORDER BY mensajes.fecha ASC";

$ver_mensajes = $db->seleccionarDatos($sql, array(':id' => $id, ':id_amigo' => $id_amigo, ':pub_id' => $_SESSION['pub_id']));

// Inicializar la variable de los chats
$mi_chats = '';

// Construir el contenedor de chat
if (isset($_SESSION['user']) && $id == $_SESSION['user']) {
    $mi_chats .= '<div class="chat">     <br>     <center>
                   <div>
                       <div style="border 5px solid white; margin-bottom:10px">
                           <img class="profile-image" style="margin-right:-20px" src="/src/views/user/img_profile/'.$img_m.'">
                           <img class="profile-image" src="/src/views/admin/html/img_profile/'.$img_f.'">
                       </div>
                       <p style="font-size:15px;color:white">Ahora están conectados en ChatPhone.</p>
                       <img class="profile-image" src="https://gifdb.com/images/high/cute-wave-emoji-hand-59s88kk0zj3xho40.gif">
                   </div>
                   </center> <br>   ';
} elseif (isset($_SESSION['admin']) && $id == $_SESSION['admin']) {
    $mi_chats .= '<div class="chat">     <br>     <center>
                   <div>
                       <div style="border 5px solid white; margin-bottom:10px">
                           <img class="profile-image" style="margin-right:-20px" src="/src/views/admin/html/img_profile/'.$img_m.'">
                           <img class="profile-image" src="/src/views/user/img_profile/'.$img_f.'">
                       </div>
                       <p style="font-size:15px;color:white">Ahora están conectados en ChatPhone.</p>
                       <img class="profile-image" src="https://gifdb.com/images/high/cute-wave-emoji-hand-59s88kk0zj3xho40.gif">
                   </div>
                   </center> <br>   ';
}

// Construir los mensajes del chat
foreach ($ver_mensajes as $mensaje) {
    $remitente = $mensaje['remitente'];
    $mensaje_texto = $mensaje['mensaje'];
    $remitente_id = $mensaje['id_remitente'];
    $id_usuario_activo = $_SESSION['id_friend'];
    $clase_css = ($remitente_id == $id_usuario_activo) ? 'yours' : 'mine';

    // Construir el mensaje HTML
    $mi_chats .= '<div class="' . $clase_css . ' messages">';
    $mi_chats .= '<div class="message last">' . $mensaje_texto . '</div>';
    $mi_chats .= '</div>';
}

// Cerrar el contenedor de chat
$mi_chats .= '</div>';

// Devolver el contenido HTML como respuesta
echo $mi_chats;
?>
