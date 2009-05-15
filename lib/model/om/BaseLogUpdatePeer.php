<?php


abstract class BaseLogUpdatePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'log_update';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.LogUpdate';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_LOG_UPDATE = 'log_update.ID_LOG_UPDATE';

	
	const USER_ID_5 = 'log_update.USER_ID_5';

	
	const FECHA = 'log_update.FECHA';

	
	const HORA = 'log_update.HORA';

	
	const DATO_NUEVO = 'log_update.DATO_NUEVO';

	
	const DATO_VIEJO = 'log_update.DATO_VIEJO';

	
	const TABLA = 'log_update.TABLA';

	
	const IP_USER = 'log_update.IP_USER';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdLogUpdate', 'UserId5', 'Fecha', 'Hora', 'DatoNuevo', 'DatoViejo', 'Tabla', 'IpUser', ),
		BasePeer::TYPE_COLNAME => array (LogUpdatePeer::ID_LOG_UPDATE, LogUpdatePeer::USER_ID_5, LogUpdatePeer::FECHA, LogUpdatePeer::HORA, LogUpdatePeer::DATO_NUEVO, LogUpdatePeer::DATO_VIEJO, LogUpdatePeer::TABLA, LogUpdatePeer::IP_USER, ),
		BasePeer::TYPE_FIELDNAME => array ('id_log_update', 'user_id_5', 'fecha', 'hora', 'dato_nuevo', 'dato_viejo', 'tabla', 'ip_user', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdLogUpdate' => 0, 'UserId5' => 1, 'Fecha' => 2, 'Hora' => 3, 'DatoNuevo' => 4, 'DatoViejo' => 5, 'Tabla' => 6, 'IpUser' => 7, ),
		BasePeer::TYPE_COLNAME => array (LogUpdatePeer::ID_LOG_UPDATE => 0, LogUpdatePeer::USER_ID_5 => 1, LogUpdatePeer::FECHA => 2, LogUpdatePeer::HORA => 3, LogUpdatePeer::DATO_NUEVO => 4, LogUpdatePeer::DATO_VIEJO => 5, LogUpdatePeer::TABLA => 6, LogUpdatePeer::IP_USER => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id_log_update' => 0, 'user_id_5' => 1, 'fecha' => 2, 'hora' => 3, 'dato_nuevo' => 4, 'dato_viejo' => 5, 'tabla' => 6, 'ip_user' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/LogUpdateMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.LogUpdateMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = LogUpdatePeer::getTableMap();
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
		return str_replace(LogUpdatePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(LogUpdatePeer::ID_LOG_UPDATE);

		$criteria->addSelectColumn(LogUpdatePeer::USER_ID_5);

		$criteria->addSelectColumn(LogUpdatePeer::FECHA);

		$criteria->addSelectColumn(LogUpdatePeer::HORA);

		$criteria->addSelectColumn(LogUpdatePeer::DATO_NUEVO);

		$criteria->addSelectColumn(LogUpdatePeer::DATO_VIEJO);

		$criteria->addSelectColumn(LogUpdatePeer::TABLA);

		$criteria->addSelectColumn(LogUpdatePeer::IP_USER);

	}

	const COUNT = 'COUNT(log_update.ID_LOG_UPDATE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT log_update.ID_LOG_UPDATE)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogUpdatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogUpdatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = LogUpdatePeer::doSelectRS($criteria, $con);
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
		$objects = LogUpdatePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return LogUpdatePeer::populateObjects(LogUpdatePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			LogUpdatePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = LogUpdatePeer::getOMClass();
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
		return LogUpdatePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(LogUpdatePeer::ID_LOG_UPDATE);
			$selectCriteria->add(LogUpdatePeer::ID_LOG_UPDATE, $criteria->remove(LogUpdatePeer::ID_LOG_UPDATE), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(LogUpdatePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(LogUpdatePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof LogUpdate) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LogUpdatePeer::ID_LOG_UPDATE, (array) $values, Criteria::IN);
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

	
	public static function doValidate(LogUpdate $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LogUpdatePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LogUpdatePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(LogUpdatePeer::DATABASE_NAME, LogUpdatePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = LogUpdatePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(LogUpdatePeer::DATABASE_NAME);

		$criteria->add(LogUpdatePeer::ID_LOG_UPDATE, $pk);


		$v = LogUpdatePeer::doSelect($criteria, $con);

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
			$criteria->add(LogUpdatePeer::ID_LOG_UPDATE, $pks, Criteria::IN);
			$objs = LogUpdatePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseLogUpdatePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/LogUpdateMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.LogUpdateMapBuilder');
}
