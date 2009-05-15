<?php



class FolderMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.FolderMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('folder');
		$tMap->setPhpName('Folder');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('folder_id_form_seq');

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'int', CreoleTypes::INTEGER, 'usuario', 'ID_USUARIO', true, null);

		$tMap->addPrimaryKey('ID_FOLDER', 'IdFolder', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('FOL_ID_USUARIO', 'FolIdUsuario', 'int', CreoleTypes::INTEGER, 'folder', 'ID_USUARIO', false, null);

		$tMap->addForeignKey('FOL_ID_FOLDER', 'FolIdFolder', 'int', CreoleTypes::INTEGER, 'folder', 'ID_FOLDER', false, null);

		$tMap->addColumn('NOMBRE_FOLDER', 'NombreFolder', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('QUOTE', 'Quote', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 