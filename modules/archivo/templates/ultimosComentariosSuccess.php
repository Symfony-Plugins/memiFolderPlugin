<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/css/main2.css') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<h2 class="title-02">Mostrando los últimos comentarios de los archivos</h2>
<?php if($comentarios){ ?>
<?php foreach ($comentarios as $comentario){ ?>
<div class="post">
				<h2 class="title"><?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario()).' comenta: ' ?></h2>
				<div class="entry">
					<?php echo $comentario->getTexto() ?>
					<br>
				</div>
				<p class="meta"><small>Comentado por: <?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario())?> | En Fecha: <?php  echo $comentario->getCreatedAt()?> | Comentando al archivo: <?php echo ObjConcretoPeer::getNombreArchivoDeComentario($comentario->getIdObjConcreto())?> | <?php echo link_to('Ver Más', 'archivo/index?archivoid='.ObjConcretoPeer::getIdArchivoDeComentario($comentario->getIdObjConcreto()))?></small></p>
</div>
<?php } ?>
<?php } ?>