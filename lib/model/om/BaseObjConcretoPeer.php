<?php


abstract class BaseObjConcretoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'obj_concreto';

	
	const CLASS_DEFAULT = 'plugins.memiFolderPlugin.lib.model.ObjConcreto';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID_USUARIO = 'obj_concreto.ID_USUARIO';

	
	const ID_FOLDER = 'obj_concreto.ID_FOLDER';

	
	const ID_OBJ_CONCRETO = 'obj_concreto.ID_OBJ_CONCRETO';

	
	const ID_TIPO_OBJ = 'obj_concreto.ID_TIPO_OBJ';

	
	const NOMBRE_OBJ = 'obj_concreto.NOMBRE_OBJ';

	
	const IS_DIGITAL = 'obj_concreto.IS_DIGITAL';

	
	const DESCRIPCION = 'obj_concreto.DESCRIPCION';

	
	const CREATED_AT = 'obj_concreto.CREATED_AT';

	
	const TEXTO = 'obj_concreto.TEXTO';

	
	const TEXTO_TSV = 'obj_concreto.TEXTO_TSV';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario', 'IdFolder', 'IdObjConcreto', 'IdTipoObj', 'NombreObj', 'IsDigital', 'Descripcion', 'CreatedAt', 'Texto', 'TextoTsv', ),
		BasePeer::TYPE_COLNAME => array (ObjConcretoPeer::ID_USUARIO, ObjConcretoPeer::ID_FOLDER, ObjConcretoPeer::ID_OBJ_CONCRETO, ObjConcretoPeer::ID_TIPO_OBJ, ObjConcretoPeer::NOMBRE_OBJ, ObjConcretoPeer::IS_DIGITAL, ObjConcretoPeer::DESCRIPCION, ObjConcretoPeer::CREATED_AT, ObjConcretoPeer::TEXTO, ObjConcretoPeer::TEXTO_TSV, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario', 'id_folder', 'id_obj_concreto', 'id_tipo_obj', 'nombre_obj', 'is_digital', 'descripcion', 'created_at', 'texto', 'texto_tsv', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IdUsuario' => 0, 'IdFolder' => 1, 'IdObjConcreto' => 2, 'IdTipoObj' => 3, 'NombreObj' => 4, 'IsDigital' => 5, 'Descripcion' => 6, 'CreatedAt' => 7, 'Texto' => 8, 'TextoTsv' => 9, ),
		BasePeer::TYPE_COLNAME => array (ObjConcretoPeer::ID_USUARIO => 0, ObjConcretoPeer::ID_FOLDER => 1, ObjConcretoPeer::ID_OBJ_CONCRETO => 2, ObjConcretoPeer::ID_TIPO_OBJ => 3, ObjConcretoPeer::NOMBRE_OBJ => 4, ObjConcretoPeer::IS_DIGITAL => 5, ObjConcretoPeer::DESCRIPCION => 6, ObjConcretoPeer::CREATED_AT => 7, ObjConcretoPeer::TEXTO => 8, ObjConcretoPeer::TEXTO_TSV => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id_usuario' => 0, 'id_folder' => 1, 'id_obj_concreto' => 2, 'id_tipo_obj' => 3, 'nombre_obj' => 4, 'is_digital' => 5, 'descripcion' => 6, 'created_at' => 7, 'texto' => 8, 'texto_tsv' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/memiFolderPlugin/lib/model/map/ObjConcretoMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.memiFolderPlugin.lib.model.map.ObjConcretoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ObjConcretoPeer::getTableMap();
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
		return str_replace(ObjConcretoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ObjConcretoPeer::ID_USUARIO);

		$criteria->addSelectColumn(ObjConcretoPeer::ID_FOLDER);

		$criteria->addSelectColumn(ObjConcretoPeer::ID_OBJ_CONCRETO);

		$criteria->addSelectColumn(ObjConcretoPeer::ID_TIPO_OBJ);

		$criteria->addSelectColumn(ObjConcretoPeer::NOMBRE_OBJ);

		$criteria->addSelectColumn(ObjConcretoPeer::IS_DIGITAL);

		$criteria->addSelectColumn(ObjConcretoPeer::DESCRIPCION);

		$criteria->addSelectColumn(ObjConcretoPeer::CREATED_AT);

		$criteria->addSelectColumn(ObjConcretoPeer::TEXTO);

		$criteria->addSelectColumn(ObjConcretoPeer::TEXTO_TSV);

	}

	const COUNT = 'COUNT(obj_concreto.ID_OBJ_CONCRETO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT obj_concreto.ID_OBJ_CONCRETO)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
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
		$objects = ObjConcretoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ObjConcretoPeer::populateObjects(ObjConcretoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ObjConcretoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ObjConcretoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFolderRelatedByIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFolderRelatedByIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTipoObj(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFolderRelatedByIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FolderPeer::addSelectColumns($c);

		$c->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FolderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFolderRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addObjConcretoRelatedByIdUsuario($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjConcretosRelatedByIdUsuario();
				$obj2->addObjConcretoRelatedByIdUsuario($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFolderRelatedByIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FolderPeer::addSelectColumns($c);

		$c->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FolderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFolderRelatedByIdFolder(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addObjConcretoRelatedByIdFolder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjConcretosRelatedByIdFolder();
				$obj2->addObjConcretoRelatedByIdFolder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTipoObj(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoObjPeer::addSelectColumns($c);

		$c->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoObjPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTipoObj(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addObjConcreto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initObjConcretos();
				$obj2->addObjConcreto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);

		$criteria->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);

		$criteria->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
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

		ObjConcretoPeer::addSelectColumns($c);
		$startcol2 = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FolderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FolderPeer::NUM_COLUMNS;

		FolderPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FolderPeer::NUM_COLUMNS;

		TipoObjPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TipoObjPeer::NUM_COLUMNS;

		$c->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);

		$c->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);

		$c->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = FolderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFolderRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjConcretoRelatedByIdUsuario($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initObjConcretosRelatedByIdUsuario();
				$obj2->addObjConcretoRelatedByIdUsuario($obj1);
			}


					
			$omClass = FolderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFolderRelatedByIdFolder(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addObjConcretoRelatedByIdFolder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initObjConcretosRelatedByIdFolder();
				$obj3->addObjConcretoRelatedByIdFolder($obj1);
			}


					
			$omClass = TipoObjPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTipoObj(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addObjConcreto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initObjConcretos();
				$obj4->addObjConcreto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptFolderRelatedByIdUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFolderRelatedByIdFolder(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTipoObj(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ObjConcretoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);

		$criteria->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);

		$rs = ObjConcretoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptFolderRelatedByIdUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol2 = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoObjPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoObjPeer::NUM_COLUMNS;

		$c->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoObjPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoObj(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjConcreto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjConcretos();
				$obj2->addObjConcreto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFolderRelatedByIdFolder(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol2 = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoObjPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoObjPeer::NUM_COLUMNS;

		$c->addJoin(ObjConcretoPeer::ID_TIPO_OBJ, TipoObjPeer::ID_TIPO_OBJ);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoObjPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoObj(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjConcreto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjConcretos();
				$obj2->addObjConcreto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTipoObj(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ObjConcretoPeer::addSelectColumns($c);
		$startcol2 = (ObjConcretoPeer::NUM_COLUMNS - ObjConcretoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FolderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FolderPeer::NUM_COLUMNS;

		FolderPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FolderPeer::NUM_COLUMNS;

		$c->addJoin(ObjConcretoPeer::ID_USUARIO, FolderPeer::ID_USUARIO);

		$c->addJoin(ObjConcretoPeer::ID_FOLDER, FolderPeer::ID_FOLDER);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ObjConcretoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FolderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFolderRelatedByIdUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addObjConcretoRelatedByIdUsuario($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initObjConcretosRelatedByIdUsuario();
				$obj2->addObjConcretoRelatedByIdUsuario($obj1);
			}

			$omClass = FolderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFolderRelatedByIdFolder(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addObjConcretoRelatedByIdFolder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initObjConcretosRelatedByIdFolder();
				$obj3->addObjConcretoRelatedByIdFolder($obj1);
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
		return ObjConcretoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ObjConcretoPeer::ID_OBJ_CONCRETO); 

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
			$comparison = $criteria->getComparison(ObjConcretoPeer::ID_OBJ_CONCRETO);
			$selectCriteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $criteria->remove(ObjConcretoPeer::ID_OBJ_CONCRETO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ObjConcretoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ObjConcretoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ObjConcreto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ObjConcreto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ObjConcretoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ObjConcretoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ObjConcretoPeer::DATABASE_NAME, ObjConcretoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ObjConcretoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ObjConcretoPeer::DATABASE_NAME);

		$criteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $pk);


		$v = ObjConcretoPeer::doSelect($criteria, $con);

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
			$criteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $pks, Criteria::IN);
			$objs = ObjConcretoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseObjConcretoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/memiFolderPlugin/lib/model/map/ObjConcretoMapBuilder.php';
	Propel::registerMapBuilder('plugins.memiFolderPlugin.lib.model.map.ObjConcretoMapBuilder');
}
