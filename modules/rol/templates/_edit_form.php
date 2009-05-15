<?php
// auto-generated by sfPropelAdmin
// date: 2008/11/09 22:27:51
?>
<?php echo form_tag('rol/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>

<?php echo object_input_hidden_tag($rol, 'getIdRol') ?>

<fieldset id="sf_fieldset_informaci__n_principal" class="">
<h2><?php echo __('Información principal') ?></h2>


<div class="form-row">
  <?php echo label_for('rol[nombre]', __($labels['rol{nombre}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('rol{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('rol{nombre}')): ?>
    <?php echo form_error('rol{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($rol, 'getNombre', array (
  'size' => 80,
  'control_name' => 'rol[nombre]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_credenciales_de_usuario" class="">
<h2><?php echo __('Credenciales de Usuario') ?></h2>


<div class="form-row">
  <?php echo label_for('rol[permiso_usuario]', __($labels['rol{permiso_usuario}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('rol{permiso_usuario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('rol{permiso_usuario}')): ?>
    <?php echo form_error('rol{permiso_usuario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = object_admin_double_list($rol, 'getPermisoUsuario', array (
  'control_name' => 'rol[permiso_usuario]',
  'through_class' => 'PermisoUser',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_credenciales_de_grupo" class="">
<h2><?php echo __('Credenciales de Grupo') ?></h2>


<div class="form-row">
  <?php echo label_for('rol[permiso_grupo1]', __($labels['rol{permiso_grupo1}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('rol{permiso_grupo1}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('rol{permiso_grupo1}')): ?>
    <?php echo form_error('rol{permiso_grupo1}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = object_admin_double_list($rol, 'getPermisoGrupo1', array (
  'control_name' => 'rol[permiso_grupo1]',
  'through_class' => 'PermisoGrupo',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('rol' => $rol)) ?>
<form>
</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($rol->getIdRol()): ?>
<?php echo button_to(__('delete'), 'rol/delete?id_rol='.$rol->getIdRol(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
