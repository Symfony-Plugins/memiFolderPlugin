<?php



class TipoRelacionMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.TipoRelacionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tipo_relacion');
		$tMap->setPhpName('TipoRelacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tipo_relacion_id_form_seq');

		$tMap->addPrimaryKey('ID_TIPORELACION', 'IdTiporelacion', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

	} 
} 