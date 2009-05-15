<?php



class UserGroupMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.UserGroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('user_group');
		$tMap->setPhpName('UserGroup');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'int' , CreoleTypes::INTEGER, 'usuario', 'ID_USUARIO', true, null);

		$tMap->addForeignPrimaryKey('ID_GROUP', 'IdGroup', 'int' , CreoleTypes::INTEGER, 'grupo', 'ID_GROUP', true, null);

	} 
} 