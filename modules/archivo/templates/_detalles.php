<b>Nombre del Archivo: </b> <?php echo $archivo->getNombreObj() ?>
<br>
<b> Descripción: </b> <?php echo $archivo->getDescripcion() ?>
<br>
<b> Subido Por: </b> <?php echo UsuarioPeer::getNombreDeUsuario($archivo->getIdUsuario()) ?>
<br>