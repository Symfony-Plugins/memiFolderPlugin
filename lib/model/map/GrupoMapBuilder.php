<?php



class GrupoMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.GrupoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('grupo');
		$tMap->setPhpName('Grupo');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('grupo_id_form_seq');

		$tMap->addPrimaryKey('ID_GROUP', 'IdGroup', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_ROL', 'IdRol', 'int', CreoleTypes::INTEGER, 'rol', 'ID_ROL', true, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::VARCHAR, false, 250);

	} 
} 