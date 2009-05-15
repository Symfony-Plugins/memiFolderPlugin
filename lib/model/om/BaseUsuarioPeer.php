<?php


abstract class BaseUsuarioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'usuario';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.Usuario';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'usuario.ID_USUARIO';

	
	const ID_ROL = 'usuario.ID_ROL';

	
	const LOGIN = 'usuario.LOGIN';

	
	const PASSWORD = 'usuario.PASSWORD';

	
	const CREATED_AT = 'usuario.CREATED_AT';

	
	const UPDATED_AT = 'usuario.UPDATED_AT';

	
	const IS_ACTIVE = 'usuario.IS_ACTIVE';

	
	const IP = 'usuario.IP';

	
	const REMENBER_KEY = 'usuario.REMENBER_KEY';

	
	const NOMBRE = 'usuario.NOMBRE';

	
	const APELLIDOS = 'usuario.APELLIDOS';

	
	const ULTIMA_ENTRADA = 'usuario.ULTIMA_ENTRADA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdRol', 'Login', 'Password', 'CreatedAt', 'UpdatedAt', 'IsActive', 'Ip', 'RemenberKey', 'Nombre', 'Apellidos', 'UltimaEntrada', ),
		BasePeer::TYPE_COLNAME => array (UsuarioPeer::ID_USUARIO, UsuarioPeer::ID_ROL, UsuarioPeer::LOGIN, UsuarioPeer::PASSWORD, UsuarioPeer::CREATED_AT, UsuarioPeer::UPDATED_AT, UsuarioPeer::IS_ACTIVE, UsuarioPeer::IP, UsuarioPeer::REMENBER_KEY, UsuarioPeer::NOMBRE, UsuarioPeer::APELLIDOS, UsuarioPeer::ULTIMA_ENTRADA, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_rol', 'login', 'password', 'created_at', 'updated_at', 'is_active', 'ip', 'remenber_key', 'nombre', 'apellidos', 'ultima_entrada', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdRol' => 1, 'Login' => 2, 'Password' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'IsActive' => 6, 'Ip' => 7, 'RemenberKey' => 8, 'Nombre' => 9, 'Apellidos' => 10, 'UltimaEntrada' => 11, ),
		BasePeer::TYPE_COLNAME => array (UsuarioPeer::ID_USUARIO => 0, UsuarioPeer::ID_ROL => 1, UsuarioPeer::LOGIN => 2, UsuarioPeer::PASSWORD => 3, UsuarioPeer::CREATED_AT => 4, UsuarioPeer::UPDATED_AT => 5, UsuarioPeer::IS_ACTIVE => 6, UsuarioPeer::IP => 7, UsuarioPeer::REMENBER_KEY => 8, UsuarioPeer::NOMBRE => 9, UsuarioPeer::APELLIDOS => 10, UsuarioPeer::ULTIMA_ENTRADA => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_rol' => 1, 'login' => 2, 'password' => 3, 'created_at' => 4, 'updated_at' => 5, 'is_active' => 6, 'ip' => 7, 'remenber_key' => 8, 'nombre' => 9, 'apellidos' => 10, 'ultima_entrada' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/UsuarioMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.UsuarioMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UsuarioPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(UsuarioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UsuarioPeer::ID_USUARIO);

		$criteria->addSelectColumn(UsuarioPeer::ID_ROL);

		$criteria->addSelectColumn(UsuarioPeer::LOGIN);

		$criteria->addSelectColumn(UsuarioPeer::PASSWORD);

		$criteria->addSelectColumn(UsuarioPeer::CREATED_AT);

		$criteria->addSelectColumn(UsuarioPeer::UPDATED_AT);

		$criteria->addSelectColumn(UsuarioPeer::IS_ACTIVE);

		$criteria->addSelectColumn(UsuarioPeer::IP);

		$criteria->addSelectColumn(UsuarioPeer::REMENBER_KEY);

		$criteria->addSelectColumn(UsuarioPeer::NOMBRE);

		$criteria->addSelectColumn(UsuarioPeer::APELLIDOS);

		$criteria->addSelectColumn(UsuarioPeer::ULTIMA_ENTRADA);

	}

	const COUNT = 'COUNT(usuario.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT usuario.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UsuarioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UsuarioPeer::populateObjects(UsuarioPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UsuarioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UsuarioPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinRol(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UsuarioPeer::ID_ROL, RolPeer::ID_ROL);

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRol(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPeer::addSelectColumns($c);
		$startcol = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RolPeer::addSelectColumns($c);

		$c->addJoin(UsuarioPeer::ID_ROL, RolPeer::ID_ROL);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RolPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRol(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUsuarios();
				$obj2->addUsuario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuarioPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuarioPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UsuarioPeer::ID_ROL, RolPeer::ID_ROL);

		$rs = UsuarioPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RolPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RolPeer::NUM_COLUMNS;

		$c->addJoin(UsuarioPeer::ID_ROL, RolPeer::ID_ROL);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = RolPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRol(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUsuarios();
				$obj2->addUsuario($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return UsuarioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UsuarioPeer::ID_USUARIO); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(UsuarioPeer::ID_USUARIO);
			$selectCriteria->add(UsuarioPeer::ID_USUARIO, $criteria->remove(UsuarioPeer::ID_USUARIO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(UsuarioPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Usuario) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsuarioPeer::ID_USUARIO, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Usuario $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsuarioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsuarioPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(UsuarioPeer::DATABASE_NAME, UsuarioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsuarioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::ID_USUARIO, $pk);


		$v = UsuarioPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(UsuarioPeer::ID_USUARIO, $pks, Criteria::IN);
			$objs = UsuarioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUsuarioPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/UsuarioMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.UsuarioMapBuilder');
}
