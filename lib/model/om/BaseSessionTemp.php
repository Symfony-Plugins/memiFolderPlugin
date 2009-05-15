<?php


abstract class BaseSessionTemp extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $session_id;


	
	protected $session_data;


	
	protected $session_time;


	
	protected $process_id;


	
	protected $created_at;


	
	protected $id_usuario;


	
	protected $nombre_usuario;


	
	protected $ip_user;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSessionId()
	{

		return $this->session_id;
	}

	
	public function getSessionData()
	{

		return $this->session_data;
	}

	
	public function getSessionTime()
	{

		return $this->session_time;
	}

	
	public function getProcessId()
	{

		return $this->process_id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getNombreUsuario()
	{

		return $this->nombre_usuario;
	}

	
	public function getIpUser()
	{

		return $this->ip_user;
	}

	
	public function setSessionId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_id !== $v) {
			$this->session_id = $v;
			$this->modifiedColumns[] = SessionTempPeer::SESSION_ID;
		}

	} 
	
	public function setSessionData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_data !== $v) {
			$this->session_data = $v;
			$this->modifiedColumns[] = SessionTempPeer::SESSION_DATA;
		}

	} 
	
	public function setSessionTime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_time !== $v) {
			$this->session_time = $v;
			$this->modifiedColumns[] = SessionTempPeer::SESSION_TIME;
		}

	} 
	
	public function setProcessId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->process_id !== $v) {
			$this->process_id = $v;
			$this->modifiedColumns[] = SessionTempPeer::PROCESS_ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = SessionTempPeer::CREATED_AT;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = SessionTempPeer::ID_USUARIO;
		}

	} 
	
	public function setNombreUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_usuario !== $v) {
			$this->nombre_usuario = $v;
			$this->modifiedColumns[] = SessionTempPeer::NOMBRE_USUARIO;
		}

	} 
	
	public function setIpUser($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_user !== $v) {
			$this->ip_user = $v;
			$this->modifiedColumns[] = SessionTempPeer::IP_USER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->session_id = $rs->getString($startcol + 0);

			$this->session_data = $rs->getString($startcol + 1);

			$this->session_time = $rs->getString($startcol + 2);

			$this->process_id = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->id_usuario = $rs->getInt($startcol + 5);

			$this->nombre_usuario = $rs->getString($startcol + 6);

			$this->ip_user = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SessionTemp object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SessionTempPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SessionTempPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SessionTempPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SessionTempPeer::DATABASE_NAME);
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
					$pk = SessionTempPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SessionTempPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = SessionTempPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SessionTempPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSessionId();
				break;
			case 1:
				return $this->getSessionData();
				break;
			case 2:
				return $this->getSessionTime();
				break;
			case 3:
				return $this->getProcessId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getIdUsuario();
				break;
			case 6:
				return $this->getNombreUsuario();
				break;
			case 7:
				return $this->getIpUser();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SessionTempPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSessionId(),
			$keys[1] => $this->getSessionData(),
			$keys[2] => $this->getSessionTime(),
			$keys[3] => $this->getProcessId(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getIdUsuario(),
			$keys[6] => $this->getNombreUsuario(),
			$keys[7] => $this->getIpUser(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SessionTempPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSessionId($value);
				break;
			case 1:
				$this->setSessionData($value);
				break;
			case 2:
				$this->setSessionTime($value);
				break;
			case 3:
				$this->setProcessId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setIdUsuario($value);
				break;
			case 6:
				$this->setNombreUsuario($value);
				break;
			case 7:
				$this->setIpUser($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SessionTempPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSessionId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSessionData($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSessionTime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setProcessId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIdUsuario($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNombreUsuario($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIpUser($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SessionTempPeer::DATABASE_NAME);

		if ($this->isColumnModified(SessionTempPeer::SESSION_ID)) $criteria->add(SessionTempPeer::SESSION_ID, $this->session_id);
		if ($this->isColumnModified(SessionTempPeer::SESSION_DATA)) $criteria->add(SessionTempPeer::SESSION_DATA, $this->session_data);
		if ($this->isColumnModified(SessionTempPeer::SESSION_TIME)) $criteria->add(SessionTempPeer::SESSION_TIME, $this->session_time);
		if ($this->isColumnModified(SessionTempPeer::PROCESS_ID)) $criteria->add(SessionTempPeer::PROCESS_ID, $this->process_id);
		if ($this->isColumnModified(SessionTempPeer::CREATED_AT)) $criteria->add(SessionTempPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SessionTempPeer::ID_USUARIO)) $criteria->add(SessionTempPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(SessionTempPeer::NOMBRE_USUARIO)) $criteria->add(SessionTempPeer::NOMBRE_USUARIO, $this->nombre_usuario);
		if ($this->isColumnModified(SessionTempPeer::IP_USER)) $criteria->add(SessionTempPeer::IP_USER, $this->ip_user);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SessionTempPeer::DATABASE_NAME);

		$criteria->add(SessionTempPeer::SESSION_ID, $this->session_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getSessionId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setSessionId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSessionData($this->session_data);

		$copyObj->setSessionTime($this->session_time);

		$copyObj->setProcessId($this->process_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setNombreUsuario($this->nombre_usuario);

		$copyObj->setIpUser($this->ip_user);


		$copyObj->setNew(true);

		$copyObj->setSessionId(NULL); 
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
			self::$peer = new SessionTempPeer();
		}
		return self::$peer;
	}

} 