<?php



class ObjDigitalMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.ObjDigitalMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('obj_digital');
		$tMap->setPhpName('ObjDigital');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_USUARIO', true, null);

		$tMap->addForeignPrimaryKey('ID_FOLDER', 'IdFolder', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_FOLDER', true, null);

		$tMap->addForeignPrimaryKey('ID_OBJ_CONCRETO', 'IdObjConcreto', 'int' , CreoleTypes::INTEGER, 'obj_concreto', 'ID_OBJ_CONCRETO', true, null);

		$tMap->addForeignKey('ID_TIPO_FILE', 'IdTipoFile', 'int', CreoleTypes::INTEGER, 'tipo_file', 'ID_TIPO_FILE', true, null);

		$tMap->addColumn('BINARY_DATA', 'BinaryData', 'string', CreoleTypes::BLOB, false, null);

		$tMap->addColumn('TAMANIO', 'Tamanio', 'string', CreoleTypes::BIGINT, false, null);

	} 
} 