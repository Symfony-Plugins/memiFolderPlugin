<?php



class PermisoUsuarioMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PermisoUsuarioMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('permiso_usuario');
		$tMap->setPhpName('PermisoUsuario');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('FORM_ID', 'FormId', 'int' , CreoleTypes::INTEGER, 'form', 'ID_FORM', true, null);

		$tMap->addForeignPrimaryKey('ROL_IDI', 'RolIdi', 'int' , CreoleTypes::INTEGER, 'rol', 'ID_ROL', true, null);

	} 
} 