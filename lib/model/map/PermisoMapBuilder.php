<?php



class PermisoMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.PermisoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('permiso');
		$tMap->setPhpName('Permiso');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('permiso_id_form_seq');

		$tMap->addPrimaryKey('ID_PERMISO', 'IdPermiso', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE_PERMISO', 'NombrePermiso', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPCIONPER', 'Descripcionper', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 