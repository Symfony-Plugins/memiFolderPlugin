<?php

/**
 * Subclass for representing a row from the 'rol' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Rol extends BaseRol
{
	public function __toString(){
		return self::getNombre();
		
	}
	public function getName(){
		return self::getNombre();
		
	}
}
