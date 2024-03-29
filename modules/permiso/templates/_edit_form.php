<?php
// auto-generated by sfPropelAdmin
// date: 2008/12/03 02:29:03
?>
<?php echo form_tag('permiso/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($permiso, 'getIdPermiso') ?>

<fieldset id="sf_fieldset_informacion_importante" class="">
<h2><?php echo __('Informacion importante') ?></h2>


<div class="form-row">
  <?php echo label_for('permiso[nombre_permiso]', __($labels['permiso{nombre_permiso}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('permiso{nombre_permiso}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('permiso{nombre_permiso}')): ?>
    <?php echo form_error('permiso{nombre_permiso}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($permiso, 'getNombrePermiso', array (
  'size' => 45,
  'control_name' => 'permiso[nombre_permiso]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('permiso[descripcionper]', __($labels['permiso{descripcionper}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('permiso{descripcionper}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('permiso{descripcionper}')): ?>
    <?php echo form_error('permiso{descripcionper}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($permiso, 'getDescripcionper', array (
  'control_name' => 'permiso[descripcionper]',
  'rich' => true,
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('Sea lo más breve porfavor') ?></div>  </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('permiso' => $permiso)) ?>
<form>
</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($permiso->getIdPermiso()): ?>
<?php echo button_to(__('Eliminar Permiso'), 'permiso/delete?id_permiso='.$permiso->getIdPermiso(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
