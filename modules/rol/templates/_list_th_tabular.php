<?php
// auto-generated by sfPropelAdmin
// date: 2008/11/09 22:27:51
?>
  <th id="sf_admin_list_th_nombre">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/rol/sort') == 'nombre'): ?>
      <?php echo link_to(__('Nombre del Rol'), 'rol/list?sort=nombre&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/rol/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/rol/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Nombre del Rol'), 'rol/list?sort=nombre&type=asc') ?>
      <?php endif; ?>
          </th>
