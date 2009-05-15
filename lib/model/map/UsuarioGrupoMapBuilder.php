<?php



class UsuarioGrupoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UsuarioGrupoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('usuario_grupo');
		$tMap->setPhpName('UsuarioGrupo');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USUARIO_ID', 'UsuarioId', 'int' , CreoleTypes::INTEGER, 'usuario', 'ID', true, null);

		$tMap->addForeignPrimaryKey('GRUPO_ID', 'GrupoId', 'int' , CreoleTypes::INTEGER, 'grupo', 'ID_GRUPO', true, null);

	} 
} 