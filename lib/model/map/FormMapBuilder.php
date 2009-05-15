<?php



class FormMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FormMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('form');
		$tMap->setPhpName('Form');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('form_id_form_seq');

		$tMap->addPrimaryKey('ID_FORM', 'IdForm', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PAGINA', 'Pagina', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('CREDENCIAL', 'Credencial', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 