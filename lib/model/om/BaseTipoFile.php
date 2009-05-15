<?php


abstract class BaseTipoFile extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_tipo_file;


	
	protected $nombre_tipo;


	
	protected $so;

	
	protected $collObjDigitals;

	
	protected $lastObjDigitalCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdTipoFile()
	{

		return $this->id_tipo_file;
	}

	
	public function getNombreTipo()
	{

		return $this->nombre_tipo;
	}

	
	public function getSo()
	{

		return $this->so;
	}

	
	public function setIdTipoFile($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tipo_file !== $v) {
			$this->id_tipo_file = $v;
			$this->modifiedColumns[] = TipoFilePeer::ID_TIPO_FILE;
		}

	} 
	
	public function setNombreTipo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_tipo !== $v) {
			$this->nombre_tipo = $v;
			$this->modifiedColumns[] = TipoFilePeer::NOMBRE_TIPO;
		}

	} 
	
	public function setSo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->so !== $v) {
			$this->so = $v;
			$this->modifiedColumns[] = TipoFilePeer::SO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_tipo_file = $rs->getInt($startcol + 0);

			$this->nombre_tipo = $rs->getString($startcol + 1);

			$this->so = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TipoFile object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoFilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TipoFilePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TipoFilePeer::DATABASE_NAME);
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
					$pk = TipoFilePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdTipoFile($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TipoFilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collObjDigitals !== null) {
				foreach($this->collObjDigitals as $referrerFK) {
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


			if (($retval = TipoFilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collObjDigitals !== null) {
					foreach($this->collObjDigitals as $referrerFK) {
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
		$pos = TipoFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdTipoFile();
				break;
			case 1:
				return $this->getNombreTipo();
				break;
			case 2:
				return $this->getSo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoFilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdTipoFile(),
			$keys[1] => $this->getNombreTipo(),
			$keys[2] => $this->getSo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoFilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdTipoFile($value);
				break;
			case 1:
				$this->setNombreTipo($value);
				break;
			case 2:
				$this->setSo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoFilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdTipoFile($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombreTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSo($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoFilePeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoFilePeer::ID_TIPO_FILE)) $criteria->add(TipoFilePeer::ID_TIPO_FILE, $this->id_tipo_file);
		if ($this->isColumnModified(TipoFilePeer::NOMBRE_TIPO)) $criteria->add(TipoFilePeer::NOMBRE_TIPO, $this->nombre_tipo);
		if ($this->isColumnModified(TipoFilePeer::SO)) $criteria->add(TipoFilePeer::SO, $this->so);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TipoFilePeer::DATABASE_NAME);

		$criteria->add(TipoFilePeer::ID_TIPO_FILE, $this->id_tipo_file);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdTipoFile();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdTipoFile($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombreTipo($this->nombre_tipo);

		$copyObj->setSo($this->so);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getObjDigitals() as $relObj) {
				$copyObj->addObjDigital($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdTipoFile(NULL); 
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
			self::$peer = new TipoFilePeer();
		}
		return self::$peer;
	}

	
	public function initObjDigitals()
	{
		if ($this->collObjDigitals === null) {
			$this->collObjDigitals = array();
		}
	}

	
	public function getObjDigitals($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitals === null) {
			if ($this->isNew()) {
			   $this->collObjDigitals = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

				ObjDigitalPeer::addSelectColumns($criteria);
				$this->collObjDigitals = ObjDigitalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

				ObjDigitalPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjDigitalCriteria) || !$this->lastObjDigitalCriteria->equals($criteria)) {
					$this->collObjDigitals = ObjDigitalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjDigitalCriteria = $criteria;
		return $this->collObjDigitals;
	}

	
	public function countObjDigitals($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

		return ObjDigitalPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjDigital(ObjDigital $l)
	{
		$this->collObjDigitals[] = $l;
		$l->setTipoFile($this);
	}


	
	public function getObjDigitalsJoinObjConcretoRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitals === null) {
			if ($this->isNew()) {
				$this->collObjDigitals = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

			if (!isset($this->lastObjDigitalCriteria) || !$this->lastObjDigitalCriteria->equals($criteria)) {
				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdUsuario($criteria, $con);
			}
		}
		$this->lastObjDigitalCriteria = $criteria;

		return $this->collObjDigitals;
	}


	
	public function getObjDigitalsJoinObjConcretoRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitals === null) {
			if ($this->isNew()) {
				$this->collObjDigitals = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdFolder($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

			if (!isset($this->lastObjDigitalCriteria) || !$this->lastObjDigitalCriteria->equals($criteria)) {
				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdFolder($criteria, $con);
			}
		}
		$this->lastObjDigitalCriteria = $criteria;

		return $this->collObjDigitals;
	}


	
	public function getObjDigitalsJoinObjConcretoRelatedByIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitals === null) {
			if ($this->isNew()) {
				$this->collObjDigitals = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdObjConcreto($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->getIdTipoFile());

			if (!isset($this->lastObjDigitalCriteria) || !$this->lastObjDigitalCriteria->equals($criteria)) {
				$this->collObjDigitals = ObjDigitalPeer::doSelectJoinObjConcretoRelatedByIdObjConcreto($criteria, $con);
			}
		}
		$this->lastObjDigitalCriteria = $criteria;

		return $this->collObjDigitals;
	}

} 