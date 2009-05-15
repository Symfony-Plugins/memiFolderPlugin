<?php


abstract class BaseUsuario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_rol;


	
	protected $login;


	
	protected $password;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $is_active;


	
	protected $ip;


	
	protected $remenber_key;


	
	protected $nombre;


	
	protected $apellidos;


	
	protected $ultima_entrada;

	
	protected $aRol;

	
	protected $collFolders;

	
	protected $lastFolderCriteria = null;

	
	protected $collSharedUsuarios;

	
	protected $lastSharedUsuarioCriteria = null;

	
	protected $collUserGroups;

	
	protected $lastUserGroupCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdRol()
	{

		return $this->id_rol;
	}

	
	public function getLogin()
	{

		return $this->login;
	}

	
	public function getPassword()
	{

		return $this->password;
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getIp()
	{

		return $this->ip;
	}

	
	public function getRemenberKey()
	{

		return $this->remenber_key;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getApellidos()
	{

		return $this->apellidos;
	}

	
	public function getUltimaEntrada($format = 'Y-m-d')
	{

		if ($this->ultima_entrada === null || $this->ultima_entrada === '') {
			return null;
		} elseif (!is_int($this->ultima_entrada)) {
						$ts = strtotime($this->ultima_entrada);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ultima_entrada] as date/time value: " . var_export($this->ultima_entrada, true));
			}
		} else {
			$ts = $this->ultima_entrada;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = UsuarioPeer::ID_USUARIO;
		}

	} 
	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = UsuarioPeer::ID_ROL;
		}

		if ($this->aRol !== null && $this->aRol->getIdRol() !== $v) {
			$this->aRol = null;
		}

	} 
	
	public function setLogin($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->login !== $v) {
			$this->login = $v;
			$this->modifiedColumns[] = UsuarioPeer::LOGIN;
		}

	} 
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UsuarioPeer::PASSWORD;
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
			$this->modifiedColumns[] = UsuarioPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = UsuarioPeer::UPDATED_AT;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = UsuarioPeer::IS_ACTIVE;
		}

	} 
	
	public function setIp($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip !== $v) {
			$this->ip = $v;
			$this->modifiedColumns[] = UsuarioPeer::IP;
		}

	} 
	
	public function setRemenberKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->remenber_key !== $v) {
			$this->remenber_key = $v;
			$this->modifiedColumns[] = UsuarioPeer::REMENBER_KEY;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = UsuarioPeer::NOMBRE;
		}

	} 
	
	public function setApellidos($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->apellidos !== $v) {
			$this->apellidos = $v;
			$this->modifiedColumns[] = UsuarioPeer::APELLIDOS;
		}

	} 
	
	public function setUltimaEntrada($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ultima_entrada] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ultima_entrada !== $ts) {
			$this->ultima_entrada = $ts;
			$this->modifiedColumns[] = UsuarioPeer::ULTIMA_ENTRADA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getInt($startcol + 0);

			$this->id_rol = $rs->getInt($startcol + 1);

			$this->login = $rs->getString($startcol + 2);

			$this->password = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->is_active = $rs->getBoolean($startcol + 6);

			$this->ip = $rs->getString($startcol + 7);

			$this->remenber_key = $rs->getString($startcol + 8);

			$this->nombre = $rs->getString($startcol + 9);

			$this->apellidos = $rs->getString($startcol + 10);

			$this->ultima_entrada = $rs->getDate($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UsuarioPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UsuarioPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
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


												
			if ($this->aRol !== null) {
				if ($this->aRol->isModified()) {
					$affectedRows += $this->aRol->save($con);
				}
				$this->setRol($this->aRol);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdUsuario($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFolders !== null) {
				foreach($this->collFolders as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSharedUsuarios !== null) {
				foreach($this->collSharedUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserGroups !== null) {
				foreach($this->collUserGroups as $referrerFK) {
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


												
			if ($this->aRol !== null) {
				if (!$this->aRol->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRol->getValidationFailures());
				}
			}


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFolders !== null) {
					foreach($this->collFolders as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSharedUsuarios !== null) {
					foreach($this->collSharedUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserGroups !== null) {
					foreach($this->collUserGroups as $referrerFK) {
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdRol();
				break;
			case 2:
				return $this->getLogin();
				break;
			case 3:
				return $this->getPassword();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			case 6:
				return $this->getIsActive();
				break;
			case 7:
				return $this->getIp();
				break;
			case 8:
				return $this->getRemenberKey();
				break;
			case 9:
				return $this->getNombre();
				break;
			case 10:
				return $this->getApellidos();
				break;
			case 11:
				return $this->getUltimaEntrada();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdRol(),
			$keys[2] => $this->getLogin(),
			$keys[3] => $this->getPassword(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
			$keys[6] => $this->getIsActive(),
			$keys[7] => $this->getIp(),
			$keys[8] => $this->getRemenberKey(),
			$keys[9] => $this->getNombre(),
			$keys[10] => $this->getApellidos(),
			$keys[11] => $this->getUltimaEntrada(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdRol($value);
				break;
			case 2:
				$this->setLogin($value);
				break;
			case 3:
				$this->setPassword($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
			case 6:
				$this->setIsActive($value);
				break;
			case 7:
				$this->setIp($value);
				break;
			case 8:
				$this->setRemenberKey($value);
				break;
			case 9:
				$this->setNombre($value);
				break;
			case 10:
				$this->setApellidos($value);
				break;
			case 11:
				$this->setUltimaEntrada($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdRol($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLogin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIp($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRemenberKey($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNombre($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setApellidos($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUltimaEntrada($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::ID_USUARIO)) $criteria->add(UsuarioPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(UsuarioPeer::ID_ROL)) $criteria->add(UsuarioPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(UsuarioPeer::LOGIN)) $criteria->add(UsuarioPeer::LOGIN, $this->login);
		if ($this->isColumnModified(UsuarioPeer::PASSWORD)) $criteria->add(UsuarioPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UsuarioPeer::CREATED_AT)) $criteria->add(UsuarioPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UsuarioPeer::UPDATED_AT)) $criteria->add(UsuarioPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(UsuarioPeer::IS_ACTIVE)) $criteria->add(UsuarioPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(UsuarioPeer::IP)) $criteria->add(UsuarioPeer::IP, $this->ip);
		if ($this->isColumnModified(UsuarioPeer::REMENBER_KEY)) $criteria->add(UsuarioPeer::REMENBER_KEY, $this->remenber_key);
		if ($this->isColumnModified(UsuarioPeer::NOMBRE)) $criteria->add(UsuarioPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(UsuarioPeer::APELLIDOS)) $criteria->add(UsuarioPeer::APELLIDOS, $this->apellidos);
		if ($this->isColumnModified(UsuarioPeer::ULTIMA_ENTRADA)) $criteria->add(UsuarioPeer::ULTIMA_ENTRADA, $this->ultima_entrada);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::ID_USUARIO, $this->id_usuario);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdUsuario();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdUsuario($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdRol($this->id_rol);

		$copyObj->setLogin($this->login);

		$copyObj->setPassword($this->password);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setIp($this->ip);

		$copyObj->setRemenberKey($this->remenber_key);

		$copyObj->setNombre($this->nombre);

		$copyObj->setApellidos($this->apellidos);

		$copyObj->setUltimaEntrada($this->ultima_entrada);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFolders() as $relObj) {
				$copyObj->addFolder($relObj->copy($deepCopy));
			}

			foreach($this->getSharedUsuarios() as $relObj) {
				$copyObj->addSharedUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getUserGroups() as $relObj) {
				$copyObj->addUserGroup($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
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
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	
	public function setRol($v)
	{


		if ($v === null) {
			$this->setIdRol(NULL);
		} else {
			$this->setIdRol($v->getIdRol());
		}


		$this->aRol = $v;
	}


	
	public function getRol($con = null)
	{
		if ($this->aRol === null && ($this->id_rol !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRolPeer.php';

			$this->aRol = RolPeer::retrieveByPK($this->id_rol, $con);

			
		}
		return $this->aRol;
	}

	
	public function initFolders()
	{
		if ($this->collFolders === null) {
			$this->collFolders = array();
		}
	}

	
	public function getFolders($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFolders === null) {
			if ($this->isNew()) {
			   $this->collFolders = array();
			} else {

				$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

				FolderPeer::addSelectColumns($criteria);
				$this->collFolders = FolderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

				FolderPeer::addSelectColumns($criteria);
				if (!isset($this->lastFolderCriteria) || !$this->lastFolderCriteria->equals($criteria)) {
					$this->collFolders = FolderPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFolderCriteria = $criteria;
		return $this->collFolders;
	}

	
	public function countFolders($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

		return FolderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFolder(Folder $l)
	{
		$this->collFolders[] = $l;
		$l->setUsuario($this);
	}


	
	public function getFoldersJoinFolderRelatedByFolIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFolders === null) {
			if ($this->isNew()) {
				$this->collFolders = array();
			} else {

				$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collFolders = FolderPeer::doSelectJoinFolderRelatedByFolIdUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastFolderCriteria) || !$this->lastFolderCriteria->equals($criteria)) {
				$this->collFolders = FolderPeer::doSelectJoinFolderRelatedByFolIdUsuario($criteria, $con);
			}
		}
		$this->lastFolderCriteria = $criteria;

		return $this->collFolders;
	}


	
	public function getFoldersJoinFolderRelatedByFolIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFolders === null) {
			if ($this->isNew()) {
				$this->collFolders = array();
			} else {

				$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collFolders = FolderPeer::doSelectJoinFolderRelatedByFolIdFolder($criteria, $con);
			}
		} else {
									
			$criteria->add(FolderPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastFolderCriteria) || !$this->lastFolderCriteria->equals($criteria)) {
				$this->collFolders = FolderPeer::doSelectJoinFolderRelatedByFolIdFolder($criteria, $con);
			}
		}
		$this->lastFolderCriteria = $criteria;

		return $this->collFolders;
	}

	
	public function initSharedUsuarios()
	{
		if ($this->collSharedUsuarios === null) {
			$this->collSharedUsuarios = array();
		}
	}

	
	public function getSharedUsuarios($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedUsuarios === null) {
			if ($this->isNew()) {
			   $this->collSharedUsuarios = array();
			} else {

				$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->getIdUsuario());

				SharedUsuarioPeer::addSelectColumns($criteria);
				$this->collSharedUsuarios = SharedUsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->getIdUsuario());

				SharedUsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastSharedUsuarioCriteria) || !$this->lastSharedUsuarioCriteria->equals($criteria)) {
					$this->collSharedUsuarios = SharedUsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSharedUsuarioCriteria = $criteria;
		return $this->collSharedUsuarios;
	}

	
	public function countSharedUsuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->getIdUsuario());

		return SharedUsuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSharedUsuario(SharedUsuario $l)
	{
		$this->collSharedUsuarios[] = $l;
		$l->setUsuario($this);
	}


	
	public function getSharedUsuariosJoinObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedUsuarios === null) {
			if ($this->isNew()) {
				$this->collSharedUsuarios = array();
			} else {

				$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collSharedUsuarios = SharedUsuarioPeer::doSelectJoinObjConcreto($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastSharedUsuarioCriteria) || !$this->lastSharedUsuarioCriteria->equals($criteria)) {
				$this->collSharedUsuarios = SharedUsuarioPeer::doSelectJoinObjConcreto($criteria, $con);
			}
		}
		$this->lastSharedUsuarioCriteria = $criteria;

		return $this->collSharedUsuarios;
	}

	
	public function initUserGroups()
	{
		if ($this->collUserGroups === null) {
			$this->collUserGroups = array();
		}
	}

	
	public function getUserGroups($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserGroups === null) {
			if ($this->isNew()) {
			   $this->collUserGroups = array();
			} else {

				$criteria->add(UserGroupPeer::ID_USUARIO, $this->getIdUsuario());

				UserGroupPeer::addSelectColumns($criteria);
				$this->collUserGroups = UserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserGroupPeer::ID_USUARIO, $this->getIdUsuario());

				UserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserGroupCriteria) || !$this->lastUserGroupCriteria->equals($criteria)) {
					$this->collUserGroups = UserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserGroupCriteria = $criteria;
		return $this->collUserGroups;
	}

	
	public function countUserGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserGroupPeer::ID_USUARIO, $this->getIdUsuario());

		return UserGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserGroup(UserGroup $l)
	{
		$this->collUserGroups[] = $l;
		$l->setUsuario($this);
	}


	
	public function getUserGroupsJoinGrupo($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUserGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserGroups === null) {
			if ($this->isNew()) {
				$this->collUserGroups = array();
			} else {

				$criteria->add(UserGroupPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collUserGroups = UserGroupPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(UserGroupPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastUserGroupCriteria) || !$this->lastUserGroupCriteria->equals($criteria)) {
				$this->collUserGroups = UserGroupPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastUserGroupCriteria = $criteria;

		return $this->collUserGroups;
	}

} 