<?php


abstract class BaseSharedGroupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'shared_group';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.SharedGroup';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_OBJ_CONCRETO = 'shared_group.ID_OBJ_CONCRETO';

	
	const ID_GROUP = 'shared_group.ID_GROUP';

	
	const ID_USUARIO = 'shared_group.ID_USUARIO';

	
	const ID_FOLDER = 'shared_group.ID_FOLDER';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdObjConcreto', 'IdGroup', 'IdUsuario', 'IdFolder', ),
		BasePeer::TYPE_COLNAME => array (SharedGroupPeer::ID_OBJ_CONCRETO, SharedGroupPeer::ID_GROUP, SharedGroupPeer::ID_USUARIO, SharedGroupPeer::ID_FOLDER, ),
		BasePeer::TYPE_FIELDNAME => array ('id_obj_concreto', 'id_group', 'id_usuario', 'id_folder', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdObjConcreto' => 0, 'IdGroup' => 1, 'IdUsuario' => 2, 'IdFolder' => 3, ),
		BasePeer::TYPE_COLNAME => array (SharedGroupPeer::ID_OBJ_CONCRETO => 0, SharedGroupPeer::ID_GROUP => 1, SharedGroupPeer::ID_USUARIO => 2, SharedGroupPeer::ID_FOLDER => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('id_obj_concreto' => 0, 'id_group' => 1, 'id_usuario' => 2, 'id_folder' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/SharedGroupMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.SharedGroupMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SharedGroupPeer::getTableMap();
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
		return str_replace(SharedGroupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SharedGroupPeer::ID_OBJ_CONCRETO);

		$criteria->addSelectColumn(SharedGroupPeer::ID_GROUP);

		$criteria->addSelectColumn(SharedGroupPeer::ID_USUARIO);

		$criteria->addSelectColumn(SharedGroupPeer::ID_FOLDER);

	}

	const COUNT = 'COUNT(shared_group.ID_OBJ_CONCRETO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT shared_group.ID_OBJ_CONCRETO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
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
		$objects = SharedGroupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SharedGroupPeer::populateObjects(SharedGroupPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SharedGroupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SharedGroupPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SharedGroupPeer::addSelectColumns($c);
		$startcol = (SharedGroupPeer::NUM_COLUMNS - SharedGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SharedGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcreto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSharedGroup($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSharedGroups();
				$obj2->addSharedGroup($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SharedGroupPeer::addSelectColumns($c);
		$startcol = (SharedGroupPeer::NUM_COLUMNS - SharedGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GrupoPeer::addSelectColumns($c);

		$c->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SharedGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GrupoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSharedGroup($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSharedGroups();
				$obj2->addSharedGroup($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
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

		SharedGroupPeer::addSelectColumns($c);
		$startcol2 = (SharedGroupPeer::NUM_COLUMNS - SharedGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		GrupoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$c->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SharedGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getObjConcreto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSharedGroup($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSharedGroups();
				$obj2->addSharedGroup($obj1);
			}


					
			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGrupo(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSharedGroup($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initSharedGroups();
				$obj3->addSharedGroup($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptGrupo(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SharedGroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = SharedGroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SharedGroupPeer::addSelectColumns($c);
		$startcol2 = (SharedGroupPeer::NUM_COLUMNS - SharedGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GrupoPeer::NUM_COLUMNS;

		$c->addJoin(SharedGroupPeer::ID_GROUP, GrupoPeer::ID_GROUP);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SharedGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GrupoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGrupo(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSharedGroup($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSharedGroups();
				$obj2->addSharedGroup($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptGrupo(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SharedGroupPeer::addSelectColumns($c);
		$startcol2 = (SharedGroupPeer::NUM_COLUMNS - SharedGroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		$c->addJoin(SharedGroupPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SharedGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getObjConcreto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSharedGroup($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSharedGroups();
				$obj2->addSharedGroup($obj1);
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
		return SharedGroupPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(SharedGroupPeer::ID_OBJ_CONCRETO);
			$selectCriteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $criteria->remove(SharedGroupPeer::ID_OBJ_CONCRETO), $comparison);

			$comparison = $criteria->getComparison(SharedGroupPeer::ID_GROUP);
			$selectCriteria->add(SharedGroupPeer::ID_GROUP, $criteria->remove(SharedGroupPeer::ID_GROUP), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SharedGroupPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SharedGroupPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SharedGroup) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $vals[0], Criteria::IN);
			$criteria->add(SharedGroupPeer::ID_GROUP, $vals[1], Criteria::IN);
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

	
	public static function doValidate(SharedGroup $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SharedGroupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SharedGroupPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SharedGroupPeer::DATABASE_NAME, SharedGroupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SharedGroupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_obj_concreto, $id_group, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $id_obj_concreto);
		$criteria->add(SharedGroupPeer::ID_GROUP, $id_group);
		$v = SharedGroupPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseSharedGroupPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/SharedGroupMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.SharedGroupMapBuilder');
}
