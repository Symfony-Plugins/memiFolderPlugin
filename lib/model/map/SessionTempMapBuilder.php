<?php



class SessionTempMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.SessionTempMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('session_temp');
		$tMap->setPhpName('SessionTemp');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('SESSION_ID', 'SessionId', 'string', CreoleTypes::VARCHAR, true, 25000);

		$tMap->addColumn('SESSION_DATA', 'SessionData', 'string', CreoleTypes::VARCHAR, false, 255000);

		$tMap->addColumn('SESSION_TIME', 'SessionTime', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('PROCESS_ID', 'ProcessId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ID_USUARIO', 'IdUsuario', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NOMBRE_USUARIO', 'NombreUsuario', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IP_USER', 'IpUser', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 