<?php

/**
 * Subclass for representing a row from the 'log_insert' table.
 *
 * 
 *
 * @package lib.model
 */ 
class LogInsert extends BaseLogInsert
{
	public static function doBitacora($nombreusuario, $ipusuario){
		//llenado de la bitacora
	  	$temp = new Criteria();
	    $temp->add(LogInsertPeer::USER_ID_1, null);
	    $registro = LogInsertPeer::doSelectOne($temp);
	    if($registro){
	    	$registro->setUserId1($nombreusuario);
	    	$registro->setIpUser($ipusuario);
	    	$registro->save();
	    }
	} 
}
