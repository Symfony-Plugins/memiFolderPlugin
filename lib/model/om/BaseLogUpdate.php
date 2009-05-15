<?php


abstract class BaseLogUpdate extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_log_update;


	
	protected $user_id_5;


	
	protected $fecha;


	
	protected $hora;


	
	protected $dato_nuevo;


	
	protected $dato_viejo;


	
	protected $tabla;


	
	protected $ip_user;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdLogUpdate()
	{

		return $this->id_log_update;
	}

	
	public function getUserId5()
	{

		return $this->user_id_5;
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

	
	public function getDatoViejo()
	{

		return $this->dato_viejo;
	}

	
	public function getTabla()
	{

		return $this->tabla;
	}

	
	public function getIpUser()
	{

		return $this->ip_user;
	}

	
	public function setIdLogUpdate($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_log_update !== $v) {
			$this->id_log_update = $v;
			$this->modifiedColumns[] = LogUpdatePeer::ID_LOG_UPDATE;
		}

	} 
	
	public function setUserId5($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_id_5 !== $v) {
			$this->user_id_5 = $v;
			$this->modifiedColumns[] = LogUpdatePeer::USER_ID_5;
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
			$this->modifiedColumns[] = LogUpdatePeer::FECHA;
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
			$this->modifiedColumns[] = LogUpdatePeer::HORA;
		}

	} 
	
	public function setDatoNuevo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dato_nuevo !== $v) {
			$this->dato_nuevo = $v;
			$this->modifiedColumns[] = LogUpdatePeer::DATO_NUEVO;
		}

	} 
	
	public function setDatoViejo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dato_viejo !== $v) {
			$this->dato_viejo = $v;
			$this->modifiedColumns[] = LogUpdatePeer::DATO_VIEJO;
		}

	} 
	
	public function setTabla($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tabla !== $v) {
			$this->tabla = $v;
			$this->modifiedColumns[] = LogUpdatePeer::TABLA;
		}

	} 
	
	public function setIpUser($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_user !== $v) {
			$this->ip_user = $v;
			$this->modifiedColumns[] = LogUpdatePeer::IP_USER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_log_update = $rs->getInt($startcol + 0);

			$this->user_id_5 = $rs->getString($startcol + 1);

			$this->fecha = $rs->getDate($startcol + 2, null);

			$this->hora = $rs->getTime($startcol + 3, null);

			$this->dato_nuevo = $rs->getString($startcol + 4);

			$this->dato_viejo = $rs->getString($startcol + 5);

			$this->tabla = $rs->getString($startcol + 6);

			$this->ip_user = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating LogUpdate object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogUpdatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LogUpdatePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(LogUpdatePeer::DATABASE_NAME);
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
					$pk = LogUpdatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += LogUpdatePeer::doUpdate($this, $con);
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


			if (($retval = LogUpdatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogUpdatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdLogUpdate();
				break;
			case 1:
				return $this->getUserId5();
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
				return $this->getDatoViejo();
				break;
			case 6:
				return $this->getTabla();
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
		$keys = LogUpdatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdLogUpdate(),
			$keys[1] => $this->getUserId5(),
			$keys[2] => $this->getFecha(),
			$keys[3] => $this->getHora(),
			$keys[4] => $this->getDatoNuevo(),
			$keys[5] => $this->getDatoViejo(),
			$keys[6] => $this->getTabla(),
			$keys[7] => $this->getIpUser(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogUpdatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdLogUpdate($value);
				break;
			case 1:
				$this->setUserId5($value);
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
				$this->setDatoViejo($value);
				break;
			case 6:
				$this->setTabla($value);
				break;
			case 7:
				$this->setIpUser($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogUpdatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdLogUpdate($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId5($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFecha($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHora($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDatoNuevo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDatoViejo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTabla($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIpUser($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LogUpdatePeer::DATABASE_NAME);

		if ($this->isColumnModified(LogUpdatePeer::ID_LOG_UPDATE)) $criteria->add(LogUpdatePeer::ID_LOG_UPDATE, $this->id_log_update);
		if ($this->isColumnModified(LogUpdatePeer::USER_ID_5)) $criteria->add(LogUpdatePeer::USER_ID_5, $this->user_id_5);
		if ($this->isColumnModified(LogUpdatePeer::FECHA)) $criteria->add(LogUpdatePeer::FECHA, $this->fecha);
		if ($this->isColumnModified(LogUpdatePeer::HORA)) $criteria->add(LogUpdatePeer::HORA, $this->hora);
		if ($this->isColumnModified(LogUpdatePeer::DATO_NUEVO)) $criteria->add(LogUpdatePeer::DATO_NUEVO, $this->dato_nuevo);
		if ($this->isColumnModified(LogUpdatePeer::DATO_VIEJO)) $criteria->add(LogUpdatePeer::DATO_VIEJO, $this->dato_viejo);
		if ($this->isColumnModified(LogUpdatePeer::TABLA)) $criteria->add(LogUpdatePeer::TABLA, $this->tabla);
		if ($this->isColumnModified(LogUpdatePeer::IP_USER)) $criteria->add(LogUpdatePeer::IP_USER, $this->ip_user);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LogUpdatePeer::DATABASE_NAME);

		$criteria->add(LogUpdatePeer::ID_LOG_UPDATE, $this->id_log_update);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdLogUpdate();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdLogUpdate($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId5($this->user_id_5);

		$copyObj->setFecha($this->fecha);

		$copyObj->setHora($this->hora);

		$copyObj->setDatoNuevo($this->dato_nuevo);

		$copyObj->setDatoViejo($this->dato_viejo);

		$copyObj->setTabla($this->tabla);

		$copyObj->setIpUser($this->ip_user);


		$copyObj->setNew(true);

		$copyObj->setIdLogUpdate(NULL); 
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
			self::$peer = new LogUpdatePeer();
		}
		return self::$peer;
	}

} 