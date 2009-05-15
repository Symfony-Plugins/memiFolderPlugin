<?php

/**
 * Subclass for performing query and update operations on the 'tipo_file' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TipoFilePeer extends BaseTipoFilePeer
{
	public static function traeNombre($idtipo){
		$resultado = false;
		if($idtipo){
			$tipo = TipoFilePeer::retrieveByPK($idtipo);
			$resultado = $tipo->getNombreTipo();
		}
		return $resultado;
	}
}
