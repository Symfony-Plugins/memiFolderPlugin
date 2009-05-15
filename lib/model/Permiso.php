<?php

/**
 * Subclass for representing a row from the 'permiso' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Permiso extends BasePermiso
{
		public function __toString(){
			return self::getNombrePermiso();
			
		}
}
