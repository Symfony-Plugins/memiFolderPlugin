<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
 
<div id="sf_admin_container">
<?php echo form_tag('folder/volver') ?>
<?php echo input_hidden_tag('lugar_almacenamiento', $direccion) ?>
<?php $sf_user->setAttribute('archivoencache', true)?>
<?php $sf_user->setAttribute('direccionarchivoencache', $direccion)?>
<h3> <?php echo 'Si el archivo '.$name.' no comienza a descargarse automáticamente puede hacer click en:'?> </h3>
<?php  echo link_to(image_tag('download_alternative.png'), 'https://'.$sf_request->getHost().'/foldertemporal/'.$name)?>
<ul class="sf_admin_actions">
    <li><?php echo submit_tag('Volver') ?></li>
  </ul>
  
</div>
