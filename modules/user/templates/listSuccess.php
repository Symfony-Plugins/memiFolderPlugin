<?php
// auto-generated by sfPropelAdmin
// date: 2008/11/18 22:36:05
?>
<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h2 class="title-01"><?php echo __('Lista de Usuarios del sistema', 
array()) ?></h2>

<div id="sf_admin_header">
<?php include_partial('user/list_header', array('pager' => $pager)) ?>
<?php include_partial('user/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_bar">
</div>

<div id="sf_admin_content">
<?php include_partial('filters', array('filters' => $filters)) ?>
<?php if (!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<?php include_partial('user/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('user/list_footer', array('pager' => $pager)) ?>
</div>

</div>
