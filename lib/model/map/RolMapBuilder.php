<?php



class RolMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.RolMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('rol');
		$tMap->setPhpName('Rol');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('rol_id_form_seq');

		$tMap->addPrimaryKey('ID_ROL', 'IdRol', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 