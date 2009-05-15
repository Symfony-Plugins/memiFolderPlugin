<? foreach ($comentarios as $comentario){ ?>
<div class="post">
				<h2 class="title"><?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario()).' comenta: ' ?></h2>
				<div class="entry">
					<?php echo $comentario->getTexto() ?>
					<br>
				</div>
				<p class="meta"><small>Comentado por: <?php echo UsuarioPeer::getNombreDeUsuario($comentario->getIdUsuario())?> | En Fecha: <?php  echo $comentario->getCreatedAt()?> |</small></p>
</div>
<? } ?>