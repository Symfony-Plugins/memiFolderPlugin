<?php



class TipoObjMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.TipoObjMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tipo_obj');
		$tMap->setPhpName('TipoObj');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tipo_obj_id_form_seq');

		$tMap->addPrimaryKey('ID_TIPO_OBJ', 'IdTipoObj', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE_TIPO_OBJ', 'NombreTipoObj', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 