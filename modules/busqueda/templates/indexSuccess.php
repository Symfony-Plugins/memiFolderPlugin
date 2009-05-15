<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('/css/main2.css') ?>
<?php echo image_tag('/images/gefoldersearch.png', 'alt=search_engine size=700x40') ?>
<?php if ($sf_flash->has('form_error')): ?>
<h3> <?php echo $sf_flash->get('form_error') ?> </h3>
<?php endif; ?>
<?php if(!$sf_params->get('avanzado')){?>
<div class="contenedoropciones2">
<h4>Realizar Búsqueda</h4>
<?php echo form_tag('busqueda/list', 'multipart=true')?>
<?php echo input_tag('palabras','','size=50x50'); ?>
<?php echo submit_tag('Buscar'); ?> &ensp;&emsp;
<br>
<?php echo link_to('Búsqueda Avanzada', 'busqueda/index?avanzado=true'); ?>
</div>
<? }else{ ?>
<div class="contenedoropciones3">
<h4 class="title-04">Realizar Búsqueda de</h4>
<?php echo form_tag('busqueda/list', 'multipart=true')?>
<?php echo input_tag('palabras'); ?>
<h3 class="title-04">**Buscar en Los siguientes Campos:</h3>
<br>
<?php echo label_for('campo2','Nombre de Archivo___','class="title-04"') ?>
<?php echo checkbox_tag('campo2','2',true);?>
<br>
<?php echo label_for('campo3','Dentro de Archivo____','class="title-04"') ?>
<?php echo checkbox_tag('campo3','3',true);?>
<br>
<?php echo label_for('campo4','Comentarios_________','class="title-04"') ?>
<?php echo checkbox_tag('campo4','4',true);?>
<br>
<h3 class="title-04">**Buscar en Grupo Especifico:</h3>
<?php echo label_for('grupo','Nombre de grupo','class=title-04') ?>
<?php echo select_tag('grupo', options_for_select($grupos, 0)) ?>
<br>
<h3 class="title-04">**Buscar en Archivos de Usuario Especifico:</h3>
<?php echo label_for('usuario','Nombre de Usuario','class=title-04') ?>
<?php echo select_tag('usuario', options_for_select($usuarios, 0)) ?>
<br>
<?php echo submit_tag('Buscar'); ?> 
<br>
</div>
<?php } ?>
<br>
<br>
<h2 class="title-04">____________</h2>
Sus últimas búsquedas:
<br>
<?php if($busquedas){?>
<?php $i=0; ?>
<?php foreach($busquedas as $busqueda){ ?>
	 <a class="title-05"> "<? echo $busquedas[$i]['contenido']?> " </a>
	en fecha: <? echo $busquedas[$i]['fecha']?>
	Nro de Resultados: <? echo $busquedas[$i]['nroresultados']?>
	<?php $i++; ?>
	<br>
<?php  } ?>
<?php } ?>