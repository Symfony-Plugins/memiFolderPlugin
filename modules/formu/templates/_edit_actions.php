<?php
// auto-generated by sfPropelAdmin
// date: 2008/12/03 02:37:37
?>
<ul class="sf_admin_actions">
    <li><?php echo button_to(__('Listar'), 'formu/list?id_form='.$formulario->getIdForm(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
    <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
    <li><?php echo submit_tag(__('Guardar y Listar'), array (
  'name' => 'save_and_list',
  'class' => 'sf_admin_action_save_and_list',
)) ?></li>
  </ul>
