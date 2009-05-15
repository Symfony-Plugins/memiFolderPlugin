<?php


abstract class BaseTipoObj extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_tipo_obj;


	
	protected $nombre_tipo_obj;

	
	protected $collObjConcretos;

	
	protected $lastObjConcretoCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdTipoObj()
	{

		return $this->id_tipo_obj;
	}

	
	public function getNombreTipoObj()
	{

		return $this->nombre_tipo_obj;
	}

	
	public function setIdTipoObj($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tipo_obj !== $v) {
			$this->id_tipo_obj = $v;
			$this->modifiedColumns[] = TipoObjPeer::ID_TIPO_OBJ;
		}

	} 
	
	public function setNombreTipoObj($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_tipo_obj !== $v) {
			$this->nombre_tipo_obj = $v;
			$this->modifiedColumns[] = TipoObjPeer::NOMBRE_TIPO_OBJ;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_tipo_obj = $rs->getInt($startcol + 0);

			$this->nombre_tipo_obj = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TipoObj object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoObjPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TipoObjPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TipoObjPeer::DATABASE_NAME);
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
					$pk = TipoObjPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdTipoObj($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TipoObjPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collObjConcretos !== null) {
				foreach($this->collObjConcretos as $referrerFK) {
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


			if (($retval = TipoObjPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collObjConcretos !== null) {
					foreach($this->collObjConcretos as $referrerFK) {
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
		$pos = TipoObjPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdTipoObj();
				break;
			case 1:
				return $this->getNombreTipoObj();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoObjPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdTipoObj(),
			$keys[1] => $this->getNombreTipoObj(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoObjPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdTipoObj($value);
				break;
			case 1:
				$this->setNombreTipoObj($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoObjPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdTipoObj($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombreTipoObj($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoObjPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoObjPeer::ID_TIPO_OBJ)) $criteria->add(TipoObjPeer::ID_TIPO_OBJ, $this->id_tipo_obj);
		if ($this->isColumnModified(TipoObjPeer::NOMBRE_TIPO_OBJ)) $criteria->add(TipoObjPeer::NOMBRE_TIPO_OBJ, $this->nombre_tipo_obj);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TipoObjPeer::DATABASE_NAME);

		$criteria->add(TipoObjPeer::ID_TIPO_OBJ, $this->id_tipo_obj);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdTipoObj();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdTipoObj($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombreTipoObj($this->nombre_tipo_obj);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getObjConcretos() as $relObj) {
				$copyObj->addObjConcreto($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdTipoObj(NULL); 
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
			self::$peer = new TipoObjPeer();
		}
		return self::$peer;
	}

	
	public function initObjConcretos()
	{
		if ($this->collObjConcretos === null) {
			$this->collObjConcretos = array();
		}
	}

	
	public function getObjConcretos($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretos === null) {
			if ($this->isNew()) {
			   $this->collObjConcretos = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

				ObjConcretoPeer::addSelectColumns($criteria);
				$this->collObjConcretos = ObjConcretoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

				ObjConcretoPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjConcretoCriteria) || !$this->lastObjConcretoCriteria->equals($criteria)) {
					$this->collObjConcretos = ObjConcretoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjConcretoCriteria = $criteria;
		return $this->collObjConcretos;
	}

	
	public function countObjConcretos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

		return ObjConcretoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjConcreto(ObjConcreto $l)
	{
		$this->collObjConcretos[] = $l;
		$l->setTipoObj($this);
	}


	
	public function getObjConcretosJoinFolderRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretos === null) {
			if ($this->isNew()) {
				$this->collObjConcretos = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

				$this->collObjConcretos = ObjConcretoPeer::doSelectJoinFolderRelatedByIdUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

			if (!isset($this->lastObjConcretoCriteria) || !$this->lastObjConcretoCriteria->equals($criteria)) {
				$this->collObjConcretos = ObjConcretoPeer::doSelectJoinFolderRelatedByIdUsuario($criteria, $con);
			}
		}
		$this->lastObjConcretoCriteria = $criteria;

		return $this->collObjConcretos;
	}


	
	public function getObjConcretosJoinFolderRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretos === null) {
			if ($this->isNew()) {
				$this->collObjConcretos = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

				$this->collObjConcretos = ObjConcretoPeer::doSelectJoinFolderRelatedByIdFolder($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->getIdTipoObj());

			if (!isset($this->lastObjConcretoCriteria) || !$this->lastObjConcretoCriteria->equals($criteria)) {
				$this->collObjConcretos = ObjConcretoPeer::doSelectJoinFolderRelatedByIdFolder($criteria, $con);
			}
		}
		$this->lastObjConcretoCriteria = $criteria;

		return $this->collObjConcretos;
	}

} 