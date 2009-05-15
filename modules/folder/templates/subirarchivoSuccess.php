<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">
<h1 class='title-01'><?php echo __('Datos del Archivo: %%nombre_permiso%%', array('%%nombre_permiso%%' => $fileupload['name'])) ?></h1>
<h1 class='title-01'> <?php if($sf_request->hasError('nombre')){echo $error;} ?></h1>
<div id="sf_admin_content">

<?php echo form_tag('folder/guardararchivo', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Nombre del Archivo') ?></h2>

<div class="form-row">
  <?php echo label_for('archivoname', 'Nombre de Archivo', '') ?>
  
  <?php $value = input_tag('archivoname', $fileupload['name'], array ('size' => 45,)); echo $value ? $value : '&nbsp;' ?>
</div>
<?php echo input_hidden_tag('archivoupdateid', $idconcreto) ?>
<?php echo input_hidden_tag('locationarchivosubido', $fileupload['path']) ?>
<?php echo input_hidden_tag('tipofile', $tipodearchivo) ?>
<?php echo input_hidden_tag('namefileincarpeta', $fileuploadname ) ?>
<?php echo input_hidden_tag('filesize', $fileupload['tamanio']) ?>
<?php echo input_hidden_tag('lugar_almacenamiento','Base de datos') ?>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Tipo de Archivo') ?></h2>

<div class="form-row">
  <?php echo ($fileupload['type']) ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Tamaño del archivo en Bytes') ?></h2>

<div class="form-row">
  <?php echo ($fileupload['tamanio']) ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Extension del archivo') ?></h2>

<div class="form-row">
  <?php echo ($tipodearchivo)  ?>
  <?php //echo ($fileupload[extension])?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Descripcion del Archivo') ?></h2>

<div class="form-row">
  <?php echo label_for('archivodescripcion', 'Información Adicional', '') ?>
  <?php if($fileupload['descripcion']){?>
  <?php $value = textarea_tag('archivodescripcion', $fileupload['descripcion'], 'rich=true size=10x20 tinymce_options=language:"es",theme_advanced_buttons2:"separator"'); echo $value ? $value : '&nbsp;' ?>
  <?php }else{ echo textarea_tag('archivodescripcion', $fileupload['descripcion'], 'rich=true size=10x20 tinymce_options=language:"es"');} ?>
</div>
</fieldset>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php //echo __('Donde desea Almacenar el archivo') ?></h2>

<div class="form-row">
  <?php //echo label_for('archivodescripcion', 'Descripcion del Archivo', '') ?>
  <?php //if($fileupload[destino] && $fileupload[destino] == 'Carpeta en S.O'){?>
  <!-- Base de Datos  
  <?php //echo radiobutton_tag('lugar_almacenamiento', 'Base de datos', false); ?>
   Carpeta en S.O
  <?php //echo radiobutton_tag('lugar_almacenamiento', $fileupload[descripcion], true); ?>
  <?php //}else{ ?>
  Base de Datos
  <?php  //	echo radiobutton_tag('lugar_almacenamiento', 'Base de datos', true); ?>
  Carpeta en S.O -->
  <?php		//	echo radiobutton_tag('lugar_almacenamiento', 'Carpeta en S.O', false); ?> 
  <?php     // } ?>
</div>
</fieldset>

<fieldset id="compartrir" class="">
<h2><?php echo __('Grupos a los cuales se puede compartir') ?></h2>

<div class="form-row">
  <?php echo label_for('grupos_shared', 'Compartir a Grupos', '') ?>
  <div class="content<?php if ($sf_request->hasError('grupos_sharesd')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('grupos_shared')): ?>
    <?php echo form_error('grupos_shared}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $obj = ObjConcretoPeer::retrieveByPK($idconcreto); 
  ?>
  <?php $value =  object_admin_double_list($obj, 'getGruposShared', 'through_class=SharedGroup associated_label=Compartir_con unassociated_label=No_compartir_con filter=compartiraGrupo
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
  <?php $obj = ObjConcretoPeer::retrieveByPK($idconcreto); 
  ?>
  <?php $value =  object_admin_double_list($obj, 'getUsuariosShared', 'through_class=SharedUsuario associated_label=Compartir_con unassociated_label=No_compartir_con filter=compartiraUsuario
  ','_get_usuarios_compartir'); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<ul class="sf_admin_actions">
	<li><?php //echo submit_tag(__('Guardar Archivo')) ?></li>
    <li><?php echo submit_tag(__('Guardar Archivo')) ?></li>
  </ul>

</div>


</div>