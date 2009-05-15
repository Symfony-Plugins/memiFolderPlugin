<?php

/**
 * Subclass for representing a row from the 'grupo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Grupo extends BaseGrupo
{
   public function __toString(){
     return self::getNombre();
   }
}
