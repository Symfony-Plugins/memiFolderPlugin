<?php

/**
 * Subclass for representing a row from the 'formulario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Formulario extends BaseFormulario
{
	public function __toString(){
     return self::getPagina();
   }
}
