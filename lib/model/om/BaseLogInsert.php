<?php


abstract class BaseLogInsert extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_log_insert;


	
	protected $user_id_1;


	
	protected $fecha;


	
	protected $hora;


	
	protected $dato_nuevo;


	
	protected $tabla;


	
	protected $ip_user;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdLogInsert()
	{

		return $this->id_log_insert;
	}

	
	public function getUserId1()
	{

		return $this->user_id_1;
	}

	
	public function getFecha($format = 'Y-m-d')
	{

		if ($this->fecha === null || $this->fecha === '') {
			return null;
		} elseif (!is_int($this->fecha)) {
						$ts = strtotime($this->fecha);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [fecha] as date/time value: " . var_export($this->fecha, true));
			}
		} else {
			$ts = $this->fecha;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getHora($format = 'H:i:s')
	{

		if ($this->hora === null || $this->hora === '') {
			return null;
		} elseif (!is_int($this->hora)) {
						$ts = strtotime($this->hora);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [hora] as date/time value: " . var_export($this->hora, true));
			}
		} else {
			$ts = $this->hora;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDatoNuevo()
	{

		return $this->dato_nuevo;
	}

	
	public function getTabla()
	{

		return $this->tabla;
	}

	
	public function getIpUser()
	{

		return $this->ip_user;
	}

	
	public function setIdLogInsert($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_log_insert !== $v) {
			$this->id_log_insert = $v;
			$this->modifiedColumns[] = LogInsertPeer::ID_LOG_INSERT;
		}

	} 
	
	public function setUserId1($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_id_1 !== $v) {
			$this->user_id_1 = $v;
			$this->modifiedColumns[] = LogInsertPeer::USER_ID_1;
		}

	} 
	
	public function setFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->fecha !== $ts) {
			$this->fecha = $ts;
			$this->modifiedColumns[] = LogInsertPeer::FECHA;
		}

	} 
	
	public function setHora($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [hora] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->hora !== $ts) {
			$this->hora = $ts;
			$this->modifiedColumns[] = LogInsertPeer::HORA;
		}

	} 
	
	public function setDatoNuevo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dato_nuevo !== $v) {
			$this->dato_nuevo = $v;
			$this->modifiedColumns[] = LogInsertPeer::DATO_NUEVO;
		}

	} 
	
	public function setTabla($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tabla !== $v) {
			$this->tabla = $v;
			$this->modifiedColumns[] = LogInsertPeer::TABLA;
		}

	} 
	
	public function setIpUser($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_user !== $v) {
			$this->ip_user = $v;
			$this->modifiedColumns[] = LogInsertPeer::IP_USER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_log_insert = $rs->getInt($startcol + 0);

			$this->user_id_1 = $rs->getString($startcol + 1);

			$this->fecha = $rs->getDate($startcol + 2, null);

			$this->hora = $rs->getTime($startcol + 3, null);

			$this->dato_nuevo = $rs->getString($startcol + 4);

			$this->tabla = $rs->getString($startcol + 5);

			$this->ip_user = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating LogInsert object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogInsertPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LogInsertPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(LogInsertPeer::DATABASE_NAME);
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
					$pk = LogInsertPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += LogInsertPeer::doUpdate($this, $con);
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


			if (($retval = LogInsertPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogInsertPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdLogInsert();
				break;
			case 1:
				return $this->getUserId1();
				break;
			case 2:
				return $this->getFecha();
				break;
			case 3:
				return $this->getHora();
				break;
			case 4:
				return $this->getDatoNuevo();
				break;
			case 5:
				return $this->getTabla();
				break;
			case 6:
				return $this->getIpUser();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogInsertPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdLogInsert(),
			$keys[1] => $this->getUserId1(),
			$keys[2] => $this->getFecha(),
			$keys[3] => $this->getHora(),
			$keys[4] => $this->getDatoNuevo(),
			$keys[5] => $this->getTabla(),
			$keys[6] => $this->getIpUser(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogInsertPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdLogInsert($value);
				break;
			case 1:
				$this->setUserId1($value);
				break;
			case 2:
				$this->setFecha($value);
				break;
			case 3:
				$this->setHora($value);
				break;
			case 4:
				$this->setDatoNuevo($value);
				break;
			case 5:
				$this->setTabla($value);
				break;
			case 6:
				$this->setIpUser($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogInsertPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdLogInsert($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId1($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFecha($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHora($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDatoNuevo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTabla($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIpUser($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LogInsertPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogInsertPeer::ID_LOG_INSERT)) $criteria->add(LogInsertPeer::ID_LOG_INSERT, $this->id_log_insert);
		if ($this->isColumnModified(LogInsertPeer::USER_ID_1)) $criteria->add(LogInsertPeer::USER_ID_1, $this->user_id_1);
		if ($this->isColumnModified(LogInsertPeer::FECHA)) $criteria->add(LogInsertPeer::FECHA, $this->fecha);
		if ($this->isColumnModified(LogInsertPeer::HORA)) $criteria->add(LogInsertPeer::HORA, $this->hora);
		if ($this->isColumnModified(LogInsertPeer::DATO_NUEVO)) $criteria->add(LogInsertPeer::DATO_NUEVO, $this->dato_nuevo);
		if ($this->isColumnModified(LogInsertPeer::TABLA)) $criteria->add(LogInsertPeer::TABLA, $this->tabla);
		if ($this->isColumnModified(LogInsertPeer::IP_USER)) $criteria->add(LogInsertPeer::IP_USER, $this->ip_user);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LogInsertPeer::DATABASE_NAME);

		$criteria->add(LogInsertPeer::ID_LOG_INSERT, $this->id_log_insert);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdLogInsert();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdLogInsert($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId1($this->user_id_1);

		$copyObj->setFecha($this->fecha);

		$copyObj->setHora($this->hora);

		$copyObj->setDatoNuevo($this->dato_nuevo);

		$copyObj->setTabla($this->tabla);

		$copyObj->setIpUser($this->ip_user);


		$copyObj->setNew(true);

		$copyObj->setIdLogInsert(NULL); 
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
			self::$peer = new LogInsertPeer();
		}
		return self::$peer;
	}

} 