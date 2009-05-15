<?php



class SharedUsuarioMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.SharedUsuarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('shared_usuario');
		$tMap->setPhpName('SharedUsuario');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('ID_FOLDER', 'IdFolder', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignPrimaryKey('ID_OBJ_CONCRETO', 'IdObjConcreto', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_OBJ_CONCRETO', true, null);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'int' , CreoleTypes::INTEGER, 'usuario', 'ID_USUARIO', true, null);

	} 
} 