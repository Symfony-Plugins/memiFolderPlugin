<?php



class PermisoGrupoMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.PermisoGrupoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('permiso_grupo');
		$tMap->setPhpName('PermisoGrupo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_ROL', 'IdRol', 'int' , CreoleTypes::INTEGER, 'rol', 'ID_ROL', true, null);

		$tMap->addForeignPrimaryKey('ID_FORM', 'IdForm', 'int' , CreoleTypes::INTEGER, 'formulario', 'ID_FORM', true, null);

		$tMap->addForeignKey('ID_PERMISO', 'IdPermiso', 'int', CreoleTypes::INTEGER, 'permiso', 'ID_PERMISO', true, null);

	} 
} 