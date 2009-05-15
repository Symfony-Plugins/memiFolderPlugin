<?php

/**
 * Subclass for representing a row from the 'log_update' table.
 *
 * 
 *
 * @package lib.model
 */ 
class LogUpdate extends BaseLogUpdate
{
	public static function doBitacora($nombreusuario, $ipusuario){
		$temp = new Criteria();
	    $temp->add(LogUpdatePeer::USER_ID_5, null);
	    $registro = LogUpdatePeer::doSelectOne($temp);
	    if($registro){
	    	$registro->setUserId5($nombreusuario);
	    	$registro->setIpUser($ipusuario);
	    	$registro->save();
	    }
		
	}
}
