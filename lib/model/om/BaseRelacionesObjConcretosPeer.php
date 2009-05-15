<?php


abstract class BaseRelacionesObjConcretosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'relaciones_obj_concretos';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.RelacionesObjConcretos';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'relaciones_obj_concretos.ID_USUARIO';

	
	const ID_FOLDER = 'relaciones_obj_concretos.ID_FOLDER';

	
	const ID_OBJ_CONCRETO = 'relaciones_obj_concretos.ID_OBJ_CONCRETO';

	
	const OBJ_ID_USUARIO = 'relaciones_obj_concretos.OBJ_ID_USUARIO';

	
	const OBJ_ID_FOLDER = 'relaciones_obj_concretos.OBJ_ID_FOLDER';

	
	const OBJ_ID_OBJ_CONCRETO = 'relaciones_obj_concretos.OBJ_ID_OBJ_CONCRETO';

	
	const ID_TIPORELACION = 'relaciones_obj_concretos.ID_TIPORELACION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdFolder', 'IdObjConcreto', 'ObjIdUsuario', 'ObjIdFolder', 'ObjIdObjConcreto', 'IdTiporelacion', ),
		BasePeer::TYPE_COLNAME => array (RelacionesObjConcretosPeer::ID_USUARIO, RelacionesObjConcretosPeer::ID_FOLDER, RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, RelacionesObjConcretosPeer::OBJ_ID_USUARIO, RelacionesObjConcretosPeer::OBJ_ID_FOLDER, RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, RelacionesObjConcretosPeer::ID_TIPORELACION, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_folder', 'id_obj_concreto', 'obj_id_usuario', 'obj_id_folder', 'obj_id_obj_concreto', 'id_tiporelacion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdFolder' => 1, 'IdObjConcreto' => 2, 'ObjIdUsuario' => 3, 'ObjIdFolder' => 4, 'ObjIdObjConcreto' => 5, 'IdTiporelacion' => 6, ),
		BasePeer::TYPE_COLNAME => array (RelacionesObjConcretosPeer::ID_USUARIO => 0, RelacionesObjConcretosPeer::ID_FOLDER => 1, RelacionesObjConcretosPeer::ID_OBJ_CONCRETO => 2, RelacionesObjConcretosPeer::OBJ_ID_USUARIO => 3, RelacionesObjConcretosPeer::OBJ_ID_FOLDER => 4, RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO => 5, RelacionesObjConcretosPeer::ID_TIPORELACION => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_folder' => 1, 'id_obj_concreto' => 2, 'obj_id_usuario' => 3, 'obj_id_folder' => 4, 'obj_id_obj_concreto' => 5, 'id_tiporelacion' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/RelacionesObjConcretosMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.RelacionesObjConcretosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RelacionesObjConcretosPeer::getTableMap();
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
		return str_replace(RelacionesObjConcretosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::ID_USUARIO);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::ID_FOLDER);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::OBJ_ID_USUARIO);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::OBJ_ID_FOLDER);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO);

		$criteria->addSelectColumn(RelacionesObjConcretosPeer::ID_TIPORELACION);

	}

	const COUNT = 'COUNT(relaciones_obj_concretos.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT relaciones_obj_concretos.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
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
		$objects = RelacionesObjConcretosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RelacionesObjConcretosPeer::populateObjects(RelacionesObjConcretosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RelacionesObjConcretosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RelacionesObjConcretosPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinObjConcretoRelatedByIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinObjConcretoRelatedByIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinObjConcretoRelatedByIdObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinObjConcretoRelatedByObjIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinObjConcretoRelatedByObjIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinObjConcretoRelatedByObjIdObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTipoRelacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinObjConcretoRelatedByIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByIdUsuario();
				$obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinObjConcretoRelatedByIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByIdFolder(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByIdFolder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByIdFolder();
				$obj2->addRelacionesObjConcretosRelatedByIdFolder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinObjConcretoRelatedByIdObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByIdObjConcreto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByIdObjConcreto();
				$obj2->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinObjConcretoRelatedByObjIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByObjIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByObjIdUsuario();
				$obj2->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinObjConcretoRelatedByObjIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByObjIdFolder(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByObjIdFolder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByObjIdFolder();
				$obj2->addRelacionesObjConcretosRelatedByObjIdFolder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinObjConcretoRelatedByObjIdObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByObjIdObjConcreto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByObjIdObjConcreto();
				$obj2->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTipoRelacion(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoRelacionPeer::addSelectColumns($c);

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRelacionesObjConcretos($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
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

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ObjConcretoPeer::NUM_COLUMNS;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByIdUsuario();
				$obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1);
			}


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getObjConcretoRelatedByIdFolder(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRelacionesObjConcretosRelatedByIdFolder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRelacionesObjConcretossRelatedByIdFolder();
				$obj3->addRelacionesObjConcretosRelatedByIdFolder($obj1);
			}


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getObjConcretoRelatedByIdObjConcreto(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRelacionesObjConcretossRelatedByIdObjConcreto();
				$obj4->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1);
			}


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getObjConcretoRelatedByObjIdUsuario(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initRelacionesObjConcretossRelatedByObjIdUsuario();
				$obj5->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1);
			}


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getObjConcretoRelatedByObjIdFolder(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addRelacionesObjConcretosRelatedByObjIdFolder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initRelacionesObjConcretossRelatedByObjIdFolder();
				$obj6->addRelacionesObjConcretosRelatedByObjIdFolder($obj1);
			}


					
			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getObjConcretoRelatedByObjIdObjConcreto(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initRelacionesObjConcretossRelatedByObjIdObjConcreto();
				$obj7->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1);
			}


					
			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addRelacionesObjConcretos($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj8->initRelacionesObjConcretoss();
				$obj8->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByIdObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByObjIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByObjIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptObjConcretoRelatedByObjIdObjConcreto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTipoRelacion(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RelacionesObjConcretosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = RelacionesObjConcretosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByIdObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByObjIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByObjIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptObjConcretoRelatedByObjIdObjConcreto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRelacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRelacionPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_TIPORELACION, TipoRelacionPeer::ID_TIPORELACION);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRelacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRelacion(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretos($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretoss();
				$obj2->addRelacionesObjConcretos($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTipoRelacion(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RelacionesObjConcretosPeer::addSelectColumns($c);
		$startcol2 = (RelacionesObjConcretosPeer::NUM_COLUMNS - RelacionesObjConcretosPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ObjConcretoPeer::NUM_COLUMNS;

		$c->addJoin(RelacionesObjConcretosPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(RelacionesObjConcretosPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RelacionesObjConcretosPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getObjConcretoRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRelacionesObjConcretossRelatedByIdUsuario();
				$obj2->addRelacionesObjConcretosRelatedByIdUsuario($obj1);
			}

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getObjConcretoRelatedByIdFolder(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRelacionesObjConcretosRelatedByIdFolder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRelacionesObjConcretossRelatedByIdFolder();
				$obj3->addRelacionesObjConcretosRelatedByIdFolder($obj1);
			}

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getObjConcretoRelatedByIdObjConcreto(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRelacionesObjConcretossRelatedByIdObjConcreto();
				$obj4->addRelacionesObjConcretosRelatedByIdObjConcreto($obj1);
			}

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getObjConcretoRelatedByObjIdUsuario(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initRelacionesObjConcretossRelatedByObjIdUsuario();
				$obj5->addRelacionesObjConcretosRelatedByObjIdUsuario($obj1);
			}

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getObjConcretoRelatedByObjIdFolder(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addRelacionesObjConcretosRelatedByObjIdFolder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initRelacionesObjConcretossRelatedByObjIdFolder();
				$obj6->addRelacionesObjConcretosRelatedByObjIdFolder($obj1);
			}

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getObjConcretoRelatedByObjIdObjConcreto(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initRelacionesObjConcretossRelatedByObjIdObjConcreto();
				$obj7->addRelacionesObjConcretosRelatedByObjIdObjConcreto($obj1);
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
		return RelacionesObjConcretosPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::ID_USUARIO);
			$selectCriteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $criteria->remove(RelacionesObjConcretosPeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::ID_FOLDER);
			$selectCriteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $criteria->remove(RelacionesObjConcretosPeer::ID_FOLDER), $comparison);

			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO);
			$selectCriteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $criteria->remove(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO), $comparison);

			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::OBJ_ID_USUARIO);
			$selectCriteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $criteria->remove(RelacionesObjConcretosPeer::OBJ_ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::OBJ_ID_FOLDER);
			$selectCriteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $criteria->remove(RelacionesObjConcretosPeer::OBJ_ID_FOLDER), $comparison);

			$comparison = $criteria->getComparison(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO);
			$selectCriteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $criteria->remove(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RelacionesObjConcretosPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RelacionesObjConcretosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RelacionesObjConcretos) {

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
				$vals[2][] = $value[2];
				$vals[3][] = $value[3];
				$vals[4][] = $value[4];
				$vals[5][] = $value[5];
			}

			$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $vals[0], Criteria::IN);
			$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $vals[1], Criteria::IN);
			$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $vals[2], Criteria::IN);
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $vals[3], Criteria::IN);
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $vals[4], Criteria::IN);
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $vals[5], Criteria::IN);
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

	
	public static function doValidate(RelacionesObjConcretos $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RelacionesObjConcretosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RelacionesObjConcretosPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RelacionesObjConcretosPeer::DATABASE_NAME, RelacionesObjConcretosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RelacionesObjConcretosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_usuario, $id_folder, $id_obj_concreto, $obj_id_usuario, $obj_id_folder, $obj_id_obj_concreto, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $id_usuario);
		$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $id_folder);
		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $id_obj_concreto);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $obj_id_usuario);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $obj_id_folder);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $obj_id_obj_concreto);
		$v = RelacionesObjConcretosPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRelacionesObjConcretosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/RelacionesObjConcretosMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.RelacionesObjConcretosMapBuilder');
}
