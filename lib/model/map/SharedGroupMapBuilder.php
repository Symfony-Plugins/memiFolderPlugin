<?php



class SharedGroupMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.SharedGroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('shared_group');
		$tMap->setPhpName('SharedGroup');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_OBJ_CONCRETO', 'IdObjConcreto', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_OBJ_CONCRETO', true, null);

		$tMap->addForeignPrimaryKey('ID_GROUP', 'IdGroup', 'int' , CreoleTypes::INTEGER, 'grupo', 'ID_GROUP', true, null);

		$tMap->addColumn('ID_USUARIO', 'IdUsuario', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ID_FOLDER', 'IdFolder', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 