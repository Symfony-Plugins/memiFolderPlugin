<?php
// auto-generated by sfPropelAdmin
// date: 2008/11/18 22:36:05
?>
<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('user/list', array('method' => 'get')) ?>
<form>
  <fieldset>
    <h2><?php echo __('Búsquedas') ?></h2>
    <div class="form-row">
    <label for="filters_id_rol"><?php echo __('rol:') ?></label>
    <div class="content">
    <?php echo object_select_tag(isset($filters['id_rol']) ? $filters['id_rol'] : null, null, array (
  'include_blank' => true,
  'related_class' => 'Rol',
  'text_method' => '__toString',
  'control_name' => 'filters[id_rol]',
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_login"><?php echo __('Nombre de usuario:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[login]', isset($filters['login']) ? $filters['login'] : null, array (
  'size' => 15,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_nombre"><?php echo __('Nombre del usuario:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[nombre]', isset($filters['nombre']) ? $filters['nombre'] : null, array (
  'size' => 15,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_is_active"><?php echo __('Está activo:') ?></label>
    <div class="content">
    <?php echo select_tag('filters[is_active]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['is_active']) ? $filters['is_active'] : null, array (
  'include_custom' => __("yes or no"),
  'type' => 'checkbox',
)), array (
  'type' => 'checkbox',
)) ?>
    </div>
    </div>

      </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('Limpiar'), 'user/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('Filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
