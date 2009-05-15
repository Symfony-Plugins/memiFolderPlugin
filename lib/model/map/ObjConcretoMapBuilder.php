<?php



class ObjConcretoMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.ObjConcretoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('obj_concreto');
		$tMap->setPhpName('ObjConcreto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('obj_concreto_id_form_seq');

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'int', CreoleTypes::INTEGER, 'folder', 'ID_USUARIO', true, null);

		$tMap->addForeignKey('ID_FOLDER', 'IdFolder', 'int', CreoleTypes::INTEGER, 'folder', 'ID_FOLDER', true, null);

		$tMap->addPrimaryKey('ID_OBJ_CONCRETO', 'IdObjConcreto', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_TIPO_OBJ', 'IdTipoObj', 'int', CreoleTypes::INTEGER, 'tipo_obj', 'ID_TIPO_OBJ', true, null);

		$tMap->addColumn('NOMBRE_OBJ', 'NombreObj', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_DIGITAL', 'IsDigital', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('TEXTO', 'Texto', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TEXTO_TSV', 'TextoTsv', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 