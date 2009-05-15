<?php



class RelacionesObjConcretosMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.RelacionesObjConcretosMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('relaciones_obj_concretos');
		$tMap->setPhpName('RelacionesObjConcretos');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_USUARIO', true, null);

		$tMap->addForeignPrimaryKey('ID_FOLDER', 'IdFolder', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_FOLDER', true, null);

		$tMap->addForeignPrimaryKey('ID_OBJ_CONCRETO', 'IdObjConcreto', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_OBJ_CONCRETO', true, null);

		$tMap->addForeignPrimaryKey('OBJ_ID_USUARIO', 'ObjIdUsuario', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_USUARIO', true, null);

		$tMap->addForeignPrimaryKey('OBJ_ID_FOLDER', 'ObjIdFolder', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_FOLDER', true, null);

		$tMap->addForeignPrimaryKey('OBJ_ID_OBJ_CONCRETO', 'ObjIdObjConcreto', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_OBJ_CONCRETO', true, null);

		$tMap->addForeignKey('ID_TIPORELACION', 'IdTiporelacion', 'int', CreoleTypes::INTEGER, 'tipo_relacion', 'ID_TIPORELACION', true, null);

	} 
} 