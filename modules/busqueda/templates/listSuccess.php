<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('/css/main2.css') ?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<br>
<?php if ($sf_flash->has('form_error')): ?>
<h3> <?php echo $sf_flash->get('form_error') ?> </h3>
<?php endif; ?>
<?php if (!$pager->getNbResults()): ?>
<h2 class="title-04"><?php echo 'No existen resultados para su búsqueda';?></h2>
<?php else: ?>
<?php include_partial('busqueda/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php $hola = $sf_user->getAttribute('eroror');
	/*foreach($hola as $error){
		echo $error.'__________';
	}*/
?>