<?php echo form_tag('archivo/guardarcomentario', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>
<?php echo input_hidden_tag('idarchivo', $idarchivo) ?>
<h1 class="title-04"> Comentar Acerca del Archivo </h1>
<?php $value = textarea_tag('archivocomentario', '', 'rich=true size=10x20 tinymce_options=language:"es"'); echo $value ? $value : '&nbsp;' ?>
<ul class="sf_admin_actions">
    <li><?php echo submit_tag(__('Guardar Comentario')) ?></li>
</ul>
