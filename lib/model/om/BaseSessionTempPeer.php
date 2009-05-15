<?php


abstract class BaseSessionTempPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'session_temp';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.SessionTemp';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SESSION_ID = 'session_temp.SESSION_ID';

	
	const SESSION_DATA = 'session_temp.SESSION_DATA';

	
	const SESSION_TIME = 'session_temp.SESSION_TIME';

	
	const PROCESS_ID = 'session_temp.PROCESS_ID';

	
	const CREATED_AT = 'session_temp.CREATED_AT';

	
	const ID_USUARIO = 'session_temp.ID_USUARIO';

	
	const NOMBRE_USUARIO = 'session_temp.NOMBRE_USUARIO';

	
	const IP_USER = 'session_temp.IP_USER';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('SessionId', 'SessionData', 'SessionTime', 'ProcessId', 'CreatedAt', 'IdUsuario', 'NombreUsuario', 'IpUser', ),
		BasePeer::TYPE_COLNAME => array (SessionTempPeer::SESSION_ID, SessionTempPeer::SESSION_DATA, SessionTempPeer::SESSION_TIME, SessionTempPeer::PROCESS_ID, SessionTempPeer::CREATED_AT, SessionTempPeer::ID_USUARIO, SessionTempPeer::NOMBRE_USUARIO, SessionTempPeer::IP_USER, ),
		BasePeer::TYPE_FIELDNAME => array ('session_id', 'session_data', 'session_time', 'process_id', 'created_at', 'id_usuario', 'nombre_usuario', 'ip_user', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('SessionId' => 0, 'SessionData' => 1, 'SessionTime' => 2, 'ProcessId' => 3, 'CreatedAt' => 4, 'IdUsuario' => 5, 'NombreUsuario' => 6, 'IpUser' => 7, ),
		BasePeer::TYPE_COLNAME => array (SessionTempPeer::SESSION_ID => 0, SessionTempPeer::SESSION_DATA => 1, SessionTempPeer::SESSION_TIME => 2, SessionTempPeer::PROCESS_ID => 3, SessionTempPeer::CREATED_AT => 4, SessionTempPeer::ID_USUARIO => 5, SessionTempPeer::NOMBRE_USUARIO => 6, SessionTempPeer::IP_USER => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('session_id' => 0, 'session_data' => 1, 'session_time' => 2, 'process_id' => 3, 'created_at' => 4, 'id_usuario' => 5, 'nombre_usuario' => 6, 'ip_user' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/SessionTempMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.SessionTempMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SessionTempPeer::getTableMap();
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
		return str_replace(SessionTempPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SessionTempPeer::SESSION_ID);

		$criteria->addSelectColumn(SessionTempPeer::SESSION_DATA);

		$criteria->addSelectColumn(SessionTempPeer::SESSION_TIME);

		$criteria->addSelectColumn(SessionTempPeer::PROCESS_ID);

		$criteria->addSelectColumn(SessionTempPeer::CREATED_AT);

		$criteria->addSelectColumn(SessionTempPeer::ID_USUARIO);

		$criteria->addSelectColumn(SessionTempPeer::NOMBRE_USUARIO);

		$criteria->addSelectColumn(SessionTempPeer::IP_USER);

	}

	const COUNT = 'COUNT(session_temp.SESSION_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT session_temp.SESSION_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SessionTempPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SessionTempPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SessionTempPeer::doSelectRS($criteria, $con);
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
		$objects = SessionTempPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SessionTempPeer::populateObjects(SessionTempPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SessionTempPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SessionTempPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return SessionTempPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(SessionTempPeer::SESSION_ID);
			$selectCriteria->add(SessionTempPeer::SESSION_ID, $criteria->remove(SessionTempPeer::SESSION_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SessionTempPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SessionTempPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SessionTemp) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SessionTempPeer::SESSION_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SessionTemp $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SessionTempPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SessionTempPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SessionTempPeer::DATABASE_NAME, SessionTempPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SessionTempPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SessionTempPeer::DATABASE_NAME);

		$criteria->add(SessionTempPeer::SESSION_ID, $pk);


		$v = SessionTempPeer::doSelect($criteria, $con);

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
			$criteria->add(SessionTempPeer::SESSION_ID, $pks, Criteria::IN);
			$objs = SessionTempPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSessionTempPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/SessionTempMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.SessionTempMapBuilder');
}
