<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<div id="sf_admin_container">
<h1 class='title-01'><?php echo __('Datos del Archivo: %%nombre_permiso%%', array('%%nombre_permiso%%' => $datos['nombrecabecera'])) ?></h1>
<h1 class='title-01'> <?php if($sf_request->hasError('nombre')){echo $error;} ?></h1>
<div id="sf_admin_content">
<?php echo form_tag('archivo/update', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Nombre del Archivo') ?></h2>

<div class="form-row">
  <?php echo label_for('archivoname', 'Nombre de Archivo', '') ?>
  
  <?php $value = input_tag('archivoname', $datos['nombre'], array ('size' => 45,)); echo $value ? $value : '&nbsp;' ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Tipo de Archivo') ?></h2>

<div class="form-row">
  <?php echo ($datos['tipo']) ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Tamaño del archivo en Bytes') ?></h2>

<div class="form-row">
  <?php echo ($datos['tamanio']) ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Descripcion del Archivo') ?></h2>

<div class="form-row">
  <?php echo label_for('archivodescripcion', 'Información Adicional', '') ?>
  <?php $value = textarea_tag('archivodescripcion', $datos['descripcion'], 'rich=true size=10x20 tinymce_options=language:"es"'); echo $value ? $value : '&nbsp;' ?>
</div>
<?php echo input_hidden_tag('archivoupdateid', $datos['id']) ?>
<?php echo input_hidden_tag('archivoupdatetipo', $datos['tipo']) ?>
<?php echo input_hidden_tag('archivoupdatetamanio', $datos['tamanio']) ?>
</fieldset>
<fieldset id="compartrir" class="">
<h2><?php echo __('Grupos a los cuales se puede compartir') ?></h2>

<div class="form-row">
  <?php echo label_for('grupos_shared', 'Compartir a Grupos', '') ?>
  <div class="content<?php if ($sf_request->hasError('grupos_shared')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('grupos_shared')): ?>
    <?php echo form_error('grupos_shared', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value =  object_admin_double_list($archivo, 'getGruposShared', 'through_class=SharedGroup associated_label=Compartir_con unassociated_label=No_compartir_con filter=compartiraGrupo
  ','_get_grupos_compartir'); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<fieldset id="compartrir2" class="">
<h2><?php echo __('Usuarios a los cuales se puede compartir') ?></h2>

<div class="form-row">
  <?php echo label_for('usuarios_shared', 'Compartir a Grupos', '') ?>
  <div class="content<?php if ($sf_request->hasError('usuarios_sharesd')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuarios_shared')): ?>
    <?php echo form_error('usuarios_shared}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value =  object_admin_double_list($archivo, 'getUsuariosShared', 'through_class=SharedUsuario associated_label=Compartir_con unassociated_label=No_compartir_con filter=compartiraUsuario
  ','_get_usuarios_compartir'); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<ul class="sf_admin_actions">
	<li><?php //echo submit_tag(__('Guardar Archivo')) ?></li>
    <li><?php echo submit_tag(__('Actualizar Archivo')) ?></li>
  </ul>

</div>


</div>