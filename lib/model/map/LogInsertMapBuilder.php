<?php



class LogInsertMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.LogInsertMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('log_insert');
		$tMap->setPhpName('LogInsert');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID_LOG_INSERT', 'IdLogInsert', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_ID_1', 'UserId1', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('FECHA', 'Fecha', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('HORA', 'Hora', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('DATO_NUEVO', 'DatoNuevo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TABLA', 'Tabla', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('IP_USER', 'IpUser', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 