<?php



class FormularioMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.FormularioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('formulario');
		$tMap->setPhpName('Formulario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('formulario_id_form_seq');

		$tMap->addPrimaryKey('ID_FORM', 'IdForm', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PAGINA', 'Pagina', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('CREDENCIAL', 'Credencial', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 