<?php



class UsuarioMapBuilder {

	
	const CLASS_NAME = 'plugins.memiFolderPlugin.lib.model.map.UsuarioMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('usuario');
		$tMap->setPhpName('Usuario');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('usuario_id_form_seq');

		$tMap->addPrimaryKey('ID_USUARIO', 'IdUsuario', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_ROL', 'IdRol', 'int', CreoleTypes::INTEGER, 'rol', 'ID_ROL', true, null);

		$tMap->addColumn('LOGIN', 'Login', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IP', 'Ip', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('REMENBER_KEY', 'RemenberKey', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('APELLIDOS', 'Apellidos', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ULTIMA_ENTRADA', 'UltimaEntrada', 'int', CreoleTypes::DATE, false, null);

	} 
} 