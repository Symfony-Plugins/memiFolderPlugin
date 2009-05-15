<?php

/**
 * Subclass for representing a row from the 'log_delete' table.
 *
 * 
 *
 * @package lib.model
 */ 
class LogDelete extends BaseLogDelete
{
	public static function doBitacora($nombreusuario, $ipusuario){
		//llenado de la bitacora
	  	$temp = new Criteria();
	    $temp->add(LogDeletePeer::USER_ID_9, null);
	    $registro = LogDeletePeer::doSelectOne($temp);
	    if($registro){
	    	$registro->setUserId9($nombreusuario);
	    	$registro->setIpUser($ipusuario);
	    	$registro->save();
	    }
	} 
}
