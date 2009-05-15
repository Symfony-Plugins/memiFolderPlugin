<?php 
$almuerzo = array('Lunes' => array('sopa','bife'), 'Martes' => array('Pollo','ensalada'));
$cosas = array();
for($n=1; $n<15; $n++){
	$cosas[$n]['id'] = 'Hola_'.$n;
	$cosas[$n]['tipo'] = 'Adios_'.$n;
}
foreach($almuerzo as $dia=>$plato){
foreach($plato as $clave=>$valor){
	echo $dia.' '. $clave.' '. $valor.'<br>';
}
}
/*foreach($cosas as $contenedor=>$id){
foreach($id as $clave=>$valor){
	echo $contenedor.' '. $clave.' '. $valor.'<br>';
}
}*/
for($n=0; $n<count($cosas)+1; $n++){
	echo $cosas[$n]['id'].'_y_'.$cosas[$n]['tipo'].'<br>';
}

$a = array('bin','doc','fla','flv','fla','html','iso','mp3','mpeg','mpg','nfo','otro','ppt','rar','swf','torrent','txt','wma','xls','zip');
foreach ($a as $tipo) {
		echo $tipo.'<br>';
 	}
?>