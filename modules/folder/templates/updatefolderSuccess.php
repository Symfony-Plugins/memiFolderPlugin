<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">
<h1 class='title-01'><?php echo __('Datos del Folder %%nombre_permiso%%', 
array('%%nombre_permiso%%' => $folderinfo->getNombreFolder())) ?></h1>
<div id="sf_admin_content">

<?php echo form_tag('folder/guardarfolder') ?>
<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Nombre del Folder') ?></h2>

<div class="form-row">
  <?php echo label_for('foldername', 'Nombre de Folder', '') ?>
  
  <?php $value = input_tag('foldername', $folderinfo->getNombreFolder(), array (
  'size' => 45,
)); echo $value ? $value : '&nbsp;' ?>
</div>
<?php echo input_hidden_tag('folderupdateid', $idfolderupdate) ?>
</fieldset>


<ul class="sf_admin_actions">
    <li><?php echo submit_tag(__('Guardar')) ?></li>
  </ul>

</div>


</div>