<? foreach ($comentarios as $comentario){ ?>
<div class="post">
				<h2 class="title"><?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario()).' comenta: ' ?></h2>
				<div class="entry">
					<?php echo $comentario->getTexto() ?>
					<br>
				</div>
				<p class="meta"><small>Comentado por: <?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario())?> | En Fecha: <?php  echo $comentario->getCreatedAt()?> | Puede Eliminar el comentario: <?php echo link_to(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('Borrar Comentario'), 'title' => __('Borrar Comentario'))), 'archivo/deletecoment?idcoment='.$comentario->getIdObjConcreto(), array ('post' => true, 'confirm' => __('Está Seguro de Eliminar el comentario de '.UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario()).' ?'))) ?> |</small></p>
</div>
<? } ?>