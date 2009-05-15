<?php

/**
 * Subclass for representing a row from the 'usuario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Usuario extends BaseUsuario
{
	/*public function getUsuarioname(){
		return self::getUsername();
	}*/
	public function __toString(){
     return self::getNombre().' '.self::getApellidos();
   }
    public function setLog(){
      
    }
    
}
