<?php



class TipoFileMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.TipoFileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tipo_file');
		$tMap->setPhpName('TipoFile');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tipo_file_id_form_seq');

		$tMap->addPrimaryKey('ID_TIPO_FILE', 'IdTipoFile', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE_TIPO', 'NombreTipo', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SO', 'So', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 