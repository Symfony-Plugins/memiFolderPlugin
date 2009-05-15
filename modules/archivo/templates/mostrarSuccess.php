<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/css/main2.css') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<h1 class="title-04"><?php echo __('Datos del Archivo: %%pagina%%', 
array('%%pagina%%' => $archivo->getNombreObj())) ?></h1>
<?php include_partial('archivo/detalles', array('archivo' => $archivo)) ?>
<b>Descargar Archivo: </b><?php echo link_to(image_tag('download_alternative.png'), $direccion) ?>
<br><br><br><br><br>
<?php if($comentarios){  ?>
<?php include_partial('archivo/comentarios', array('comentarios' => $comentarios)) ?>
<?php }else{ ?>
<h1 class="title-04"> No existen comentarios del Archivo </h1>
<?php } ?>
<br><br><br><br><br>
<?php include_partial('archivo/comentar_form', array('idarchivo' => $archivo->getIdObjConcreto())) ?>