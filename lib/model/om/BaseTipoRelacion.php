<?php


abstract class BaseTipoRelacion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_tiporelacion;


	
	protected $nombre;

	
	protected $collRelacionesObjConcretoss;

	
	protected $lastRelacionesObjConcretosCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdTiporelacion()
	{

		return $this->id_tiporelacion;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function setIdTiporelacion($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tiporelacion !== $v) {
			$this->id_tiporelacion = $v;
			$this->modifiedColumns[] = TipoRelacionPeer::ID_TIPORELACION;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = TipoRelacionPeer::NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_tiporelacion = $rs->getInt($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TipoRelacion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoRelacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TipoRelacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoRelacionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TipoRelacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdTiporelacion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TipoRelacionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collRelacionesObjConcretoss !== null) {
				foreach($this->collRelacionesObjConcretoss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = TipoRelacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRelacionesObjConcretoss !== null) {
					foreach($this->collRelacionesObjConcretoss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoRelacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdTiporelacion();
				break;
			case 1:
				return $this->getNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoRelacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdTiporelacion(),
			$keys[1] => $this->getNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoRelacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdTiporelacion($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoRelacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdTiporelacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoRelacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoRelacionPeer::ID_TIPORELACION)) $criteria->add(TipoRelacionPeer::ID_TIPORELACION, $this->id_tiporelacion);
		if ($this->isColumnModified(TipoRelacionPeer::NOMBRE)) $criteria->add(TipoRelacionPeer::NOMBRE, $this->nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TipoRelacionPeer::DATABASE_NAME);

		$criteria->add(TipoRelacionPeer::ID_TIPORELACION, $this->id_tiporelacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdTiporelacion();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdTiporelacion($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombre($this->nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getRelacionesObjConcretoss() as $relObj) {
				$copyObj->addRelacionesObjConcretos($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdTiporelacion(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TipoRelacionPeer();
		}
		return self::$peer;
	}

	
	public function initRelacionesObjConcretoss()
	{
		if ($this->collRelacionesObjConcretoss === null) {
			$this->collRelacionesObjConcretoss = array();
		}
	}

	
	public function getRelacionesObjConcretoss($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;
		return $this->collRelacionesObjConcretoss;
	}

	
	public function countRelacionesObjConcretoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretos(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretoss[] = $l;
		$l->setTipoRelacion($this);
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdUsuario($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdFolder($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdFolder($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdObjConcreto($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByIdObjConcreto($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByObjIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdUsuario($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByObjIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdFolder($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdFolder($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}


	
	public function getRelacionesObjConcretossJoinObjConcretoRelatedByObjIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretoss === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretoss = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdObjConcreto($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->getIdTiporelacion());

			if (!isset($this->lastRelacionesObjConcretosCriteria) || !$this->lastRelacionesObjConcretosCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretoss = RelacionesObjConcretosPeer::doSelectJoinObjConcretoRelatedByObjIdObjConcreto($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosCriteria = $criteria;

		return $this->collRelacionesObjConcretoss;
	}

} 