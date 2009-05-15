<?php


abstract class BaseObjDigitalPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'obj_digital';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.ObjDigital';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'obj_digital.ID_USUARIO';

	
	const ID_FOLDER = 'obj_digital.ID_FOLDER';

	
	const ID_OBJ_CONCRETO = 'obj_digital.ID_OBJ_CONCRETO';

	
	const ID_TIPO_FILE = 'obj_digital.ID_TIPO_FILE';

	
	const BINARY_DATA = 'obj_digital.BINARY_DATA';

	
	const TAMANIO = 'obj_digital.TAMANIO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdFolder', 'IdObjConcreto', 'IdTipoFile', 'BinaryData', 'Tamanio', ),
		BasePeer::TYPE_COLNAME => array (ObjDigitalPeer::ID_USUARIO, ObjDigitalPeer::ID_FOLDER, ObjDigitalPeer::ID_OBJ_CONCRETO, ObjDigitalPeer::ID_TIPO_FILE, ObjDigitalPeer::BINARY_DATA, ObjDigitalPeer::TAMANIO, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_folder', 'id_obj_concreto', 'id_tipo_file', 'binary_data', 'tamanio', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdFolder' => 1, 'IdObjConcreto' => 2, 'IdTipoFile' => 3, 'BinaryData' => 4, 'Tamanio' => 5, ),
		BasePeer::TYPE_COLNAME => array (ObjDigitalPeer::ID_USUARIO => 0, ObjDigitalPeer::ID_FOLDER => 1, ObjDigitalPeer::ID_OBJ_CONCRETO => 2, ObjDigitalPeer::ID_TIPO_FILE => 3, ObjDigitalPeer::BINARY_DATA => 4, ObjDigitalPeer::TAMANIO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_folder' => 1, 'id_obj_concreto' => 2, 'id_tipo_file' => 3, 'binary_data' => 4, 'tamanio' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/ObjDigitalMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.ObjDigitalMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ObjDigitalPeer::getTableMap();
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
		return str_replace(ObjDigitalPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ObjDigitalPeer::ID_USUARIO);

		$criteria->addSelectColumn(ObjDigitalPeer::ID_FOLDER);

		$criteria->addSelectColumn(ObjDigitalPeer::ID_OBJ_CONCRETO);

		$criteria->addSelectColumn(ObjDigitalPeer::ID_TIPO_FILE);

		$criteria->addSelectColumn(ObjDigitalPeer::BINARY_DATA);

		$criteria->addSelectColumn(ObjDigitalPeer::TAMANIO);

	}

	const COUNT = 'COUNT(obj_digital.ID_USUARIO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT obj_digital.ID_USUARIO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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
		$objects = ObjDigitalPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ObjDigitalPeer::populateObjects(ObjDigitalPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ObjDigitalPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ObjDigitalPeer::getOMClass();
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTipoFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

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
										$temp_obj2->addObjDigitalRelatedByIdUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjDigitalsRelatedByIdUsuario();
				$obj2->addObjDigitalRelatedByIdUsuario($obj1); 			}
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

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
										$temp_obj2->addObjDigitalRelatedByIdFolder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjDigitalsRelatedByIdFolder();
				$obj2->addObjDigitalRelatedByIdFolder($obj1); 			}
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ObjConcretoPeer::addSelectColumns($c);

		$c->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

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
										$temp_obj2->addObjDigitalRelatedByIdObjConcreto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjDigitalsRelatedByIdObjConcreto();
				$obj2->addObjDigitalRelatedByIdObjConcreto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTipoFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjDigitalPeer::addSelectColumns($c);
		$startcol = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoFilePeer::addSelectColumns($c);

		$c->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoFilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTipoFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addObjDigital($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjDigitals();
				$obj2->addObjDigital($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol2 = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ObjConcretoPeer::NUM_COLUMNS;

		TipoFilePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TipoFilePeer::NUM_COLUMNS;

		$c->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$c->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();


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
					$temp_obj2->addObjDigitalRelatedByIdUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initObjDigitalsRelatedByIdUsuario();
				$obj2->addObjDigitalRelatedByIdUsuario($obj1);
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
					$temp_obj3->addObjDigitalRelatedByIdFolder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initObjDigitalsRelatedByIdFolder();
				$obj3->addObjDigitalRelatedByIdFolder($obj1);
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
					$temp_obj4->addObjDigitalRelatedByIdObjConcreto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initObjDigitalsRelatedByIdObjConcreto();
				$obj4->addObjDigitalRelatedByIdObjConcreto($obj1);
			}


					
			$omClass = TipoFilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTipoFile(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addObjDigital($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initObjDigitals();
				$obj5->addObjDigital($obj1);
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTipoFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjDigitalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$criteria->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$criteria->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);

		$rs = ObjDigitalPeer::doSelectRS($criteria, $con);
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol2 = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoFilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoFilePeer::NUM_COLUMNS;

		$c->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoFilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjDigital($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjDigitals();
				$obj2->addObjDigital($obj1);
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol2 = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoFilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoFilePeer::NUM_COLUMNS;

		$c->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoFilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjDigital($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjDigitals();
				$obj2->addObjDigital($obj1);
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

		ObjDigitalPeer::addSelectColumns($c);
		$startcol2 = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoFilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoFilePeer::NUM_COLUMNS;

		$c->addJoin(ObjDigitalPeer::ID_TIPO_FILE, TipoFilePeer::ID_TIPO_FILE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoFilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjDigital($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjDigitals();
				$obj2->addObjDigital($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTipoFile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjDigitalPeer::addSelectColumns($c);
		$startcol2 = (ObjDigitalPeer::NUM_COLUMNS - ObjDigitalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ObjConcretoPeer::NUM_COLUMNS;

		ObjConcretoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ObjConcretoPeer::NUM_COLUMNS;

		$c->addJoin(ObjDigitalPeer::ID_USUARIO, ObjConcretoPeer::ID_USUARIO);

		$c->addJoin(ObjDigitalPeer::ID_FOLDER, ObjConcretoPeer::ID_FOLDER);

		$c->addJoin(ObjDigitalPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_OBJ_CONCRETO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjDigitalPeer::getOMClass();

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
					$temp_obj2->addObjDigitalRelatedByIdUsuario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjDigitalsRelatedByIdUsuario();
				$obj2->addObjDigitalRelatedByIdUsuario($obj1);
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
					$temp_obj3->addObjDigitalRelatedByIdFolder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initObjDigitalsRelatedByIdFolder();
				$obj3->addObjDigitalRelatedByIdFolder($obj1);
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
					$temp_obj4->addObjDigitalRelatedByIdObjConcreto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initObjDigitalsRelatedByIdObjConcreto();
				$obj4->addObjDigitalRelatedByIdObjConcreto($obj1);
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
		return ObjDigitalPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ObjDigitalPeer::ID_USUARIO);
			$selectCriteria->add(ObjDigitalPeer::ID_USUARIO, $criteria->remove(ObjDigitalPeer::ID_USUARIO), $comparison);

			$comparison = $criteria->getComparison(ObjDigitalPeer::ID_FOLDER);
			$selectCriteria->add(ObjDigitalPeer::ID_FOLDER, $criteria->remove(ObjDigitalPeer::ID_FOLDER), $comparison);

			$comparison = $criteria->getComparison(ObjDigitalPeer::ID_OBJ_CONCRETO);
			$selectCriteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $criteria->remove(ObjDigitalPeer::ID_OBJ_CONCRETO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ObjDigitalPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ObjDigitalPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ObjDigital) {

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
			}

			$criteria->add(ObjDigitalPeer::ID_USUARIO, $vals[0], Criteria::IN);
			$criteria->add(ObjDigitalPeer::ID_FOLDER, $vals[1], Criteria::IN);
			$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $vals[2], Criteria::IN);
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

	
	public static function doValidate(ObjDigital $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ObjDigitalPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ObjDigitalPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ObjDigitalPeer::DATABASE_NAME, ObjDigitalPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ObjDigitalPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $id_usuario, $id_folder, $id_obj_concreto, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ObjDigitalPeer::ID_USUARIO, $id_usuario);
		$criteria->add(ObjDigitalPeer::ID_FOLDER, $id_folder);
		$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $id_obj_concreto);
		$v = ObjDigitalPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseObjDigitalPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/ObjDigitalMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.ObjDigitalMapBuilder');
}
