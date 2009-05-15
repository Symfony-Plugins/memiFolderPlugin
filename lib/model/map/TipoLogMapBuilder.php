<?php



class TipoLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TipoLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tipo_log');
		$tMap->setPhpName('TipoLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID_LOG', 'IdLog', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 