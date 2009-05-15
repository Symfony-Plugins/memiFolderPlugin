<?php


abstract class BaseTipoLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_log;


	
	protected $name;

	
	protected $collLogDeletes;

	
	protected $lastLogDeleteCriteria = null;

	
	protected $collLogInserts;

	
	protected $lastLogInsertCriteria = null;

	
	protected $collLogUpdates;

	
	protected $lastLogUpdateCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdLog()
	{

		return $this->id_log;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function setIdLog($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_log !== $v) {
			$this->id_log = $v;
			$this->modifiedColumns[] = TipoLogPeer::ID_LOG;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = TipoLogPeer::NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_log = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TipoLog object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoLog:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TipoLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTipoLog:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoLog:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTipoLog:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

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
					$pk = TipoLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TipoLogPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collLogDeletes !== null) {
				foreach($this->collLogDeletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLogInserts !== null) {
				foreach($this->collLogInserts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLogUpdates !== null) {
				foreach($this->collLogUpdates as $referrerFK) {
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


			if (($retval = TipoLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLogDeletes !== null) {
					foreach($this->collLogDeletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLogInserts !== null) {
					foreach($this->collLogInserts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLogUpdates !== null) {
					foreach($this->collLogUpdates as $referrerFK) {
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
		$pos = TipoLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdLog();
				break;
			case 1:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdLog(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdLog($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdLog($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoLogPeer::ID_LOG)) $criteria->add(TipoLogPeer::ID_LOG, $this->id_log);
		if ($this->isColumnModified(TipoLogPeer::NAME)) $criteria->add(TipoLogPeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TipoLogPeer::DATABASE_NAME);

		$criteria->add(TipoLogPeer::ID_LOG, $this->id_log);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdLog();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdLog($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getLogDeletes() as $relObj) {
				$copyObj->addLogDelete($relObj->copy($deepCopy));
			}

			foreach($this->getLogInserts() as $relObj) {
				$copyObj->addLogInsert($relObj->copy($deepCopy));
			}

			foreach($this->getLogUpdates() as $relObj) {
				$copyObj->addLogUpdate($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdLog(NULL); 
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
			self::$peer = new TipoLogPeer();
		}
		return self::$peer;
	}

	
	public function initLogDeletes()
	{
		if ($this->collLogDeletes === null) {
			$this->collLogDeletes = array();
		}
	}

	
	public function getLogDeletes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLogDeletePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogDeletes === null) {
			if ($this->isNew()) {
			   $this->collLogDeletes = array();
			} else {

				$criteria->add(LogDeletePeer::ID_LOG, $this->getIdLog());

				LogDeletePeer::addSelectColumns($criteria);
				$this->collLogDeletes = LogDeletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LogDeletePeer::ID_LOG, $this->getIdLog());

				LogDeletePeer::addSelectColumns($criteria);
				if (!isset($this->lastLogDeleteCriteria) || !$this->lastLogDeleteCriteria->equals($criteria)) {
					$this->collLogDeletes = LogDeletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogDeleteCriteria = $criteria;
		return $this->collLogDeletes;
	}

	
	public function countLogDeletes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLogDeletePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogDeletePeer::ID_LOG, $this->getIdLog());

		return LogDeletePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLogDelete(LogDelete $l)
	{
		$this->collLogDeletes[] = $l;
		$l->setTipoLog($this);
	}

	
	public function initLogInserts()
	{
		if ($this->collLogInserts === null) {
			$this->collLogInserts = array();
		}
	}

	
	public function getLogInserts($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLogInsertPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogInserts === null) {
			if ($this->isNew()) {
			   $this->collLogInserts = array();
			} else {

				$criteria->add(LogInsertPeer::ID_LOG, $this->getIdLog());

				LogInsertPeer::addSelectColumns($criteria);
				$this->collLogInserts = LogInsertPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LogInsertPeer::ID_LOG, $this->getIdLog());

				LogInsertPeer::addSelectColumns($criteria);
				if (!isset($this->lastLogInsertCriteria) || !$this->lastLogInsertCriteria->equals($criteria)) {
					$this->collLogInserts = LogInsertPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogInsertCriteria = $criteria;
		return $this->collLogInserts;
	}

	
	public function countLogInserts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLogInsertPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogInsertPeer::ID_LOG, $this->getIdLog());

		return LogInsertPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLogInsert(LogInsert $l)
	{
		$this->collLogInserts[] = $l;
		$l->setTipoLog($this);
	}

	
	public function initLogUpdates()
	{
		if ($this->collLogUpdates === null) {
			$this->collLogUpdates = array();
		}
	}

	
	public function getLogUpdates($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLogUpdatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogUpdates === null) {
			if ($this->isNew()) {
			   $this->collLogUpdates = array();
			} else {

				$criteria->add(LogUpdatePeer::ID_LOG, $this->getIdLog());

				LogUpdatePeer::addSelectColumns($criteria);
				$this->collLogUpdates = LogUpdatePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LogUpdatePeer::ID_LOG, $this->getIdLog());

				LogUpdatePeer::addSelectColumns($criteria);
				if (!isset($this->lastLogUpdateCriteria) || !$this->lastLogUpdateCriteria->equals($criteria)) {
					$this->collLogUpdates = LogUpdatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogUpdateCriteria = $criteria;
		return $this->collLogUpdates;
	}

	
	public function countLogUpdates($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLogUpdatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogUpdatePeer::ID_LOG, $this->getIdLog());

		return LogUpdatePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLogUpdate(LogUpdate $l)
	{
		$this->collLogUpdates[] = $l;
		$l->setTipoLog($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTipoLog:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTipoLog::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 