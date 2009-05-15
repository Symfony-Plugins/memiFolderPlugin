<?php


abstract class BaseGrupo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_group;


	
	protected $id_rol;


	
	protected $nombre;


	
	protected $descripcion;

	
	protected $aRol;

	
	protected $collSharedGroups;

	
	protected $lastSharedGroupCriteria = null;

	
	protected $collUserGroups;

	
	protected $lastUserGroupCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdGroup()
	{

		return $this->id_group;
	}

	
	public function getIdRol()
	{

		return $this->id_rol;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
	}

	
	public function setIdGroup($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_group !== $v) {
			$this->id_group = $v;
			$this->modifiedColumns[] = GrupoPeer::ID_GROUP;
		}

	} 
	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = GrupoPeer::ID_ROL;
		}

		if ($this->aRol !== null && $this->aRol->getIdRol() !== $v) {
			$this->aRol = null;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = GrupoPeer::NOMBRE;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = GrupoPeer::DESCRIPCION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_group = $rs->getInt($startcol + 0);

			$this->id_rol = $rs->getInt($startcol + 1);

			$this->nombre = $rs->getString($startcol + 2);

			$this->descripcion = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Grupo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GrupoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME);
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
					$pk = GrupoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdGroup($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GrupoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSharedGroups !== null) {
				foreach($this->collSharedGroups as $referrerFK) {
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


			if (($retval = GrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSharedGroups !== null) {
					foreach($this->collSharedGroups as $referrerFK) {
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
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdGroup();
				break;
			case 1:
				return $this->getIdRol();
				break;
			case 2:
				return $this->getNombre();
				break;
			case 3:
				return $this->getDescripcion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdGroup(),
			$keys[1] => $this->getIdRol(),
			$keys[2] => $this->getNombre(),
			$keys[3] => $this->getDescripcion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdGroup($value);
				break;
			case 1:
				$this->setIdRol($value);
				break;
			case 2:
				$this->setNombre($value);
				break;
			case 3:
				$this->setDescripcion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdGroup($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdRol($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescripcion($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoPeer::ID_GROUP)) $criteria->add(GrupoPeer::ID_GROUP, $this->id_group);
		if ($this->isColumnModified(GrupoPeer::ID_ROL)) $criteria->add(GrupoPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(GrupoPeer::NOMBRE)) $criteria->add(GrupoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(GrupoPeer::DESCRIPCION)) $criteria->add(GrupoPeer::DESCRIPCION, $this->descripcion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		$criteria->add(GrupoPeer::ID_GROUP, $this->id_group);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdGroup();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdGroup($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdRol($this->id_rol);

		$copyObj->setNombre($this->nombre);

		$copyObj->setDescripcion($this->descripcion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSharedGroups() as $relObj) {
				$copyObj->addSharedGroup($relObj->copy($deepCopy));
			}

			foreach($this->getUserGroups() as $relObj) {
				$copyObj->addUserGroup($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdGroup(NULL); 
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
			self::$peer = new GrupoPeer();
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

	
	public function initSharedGroups()
	{
		if ($this->collSharedGroups === null) {
			$this->collSharedGroups = array();
		}
	}

	
	public function getSharedGroups($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedGroups === null) {
			if ($this->isNew()) {
			   $this->collSharedGroups = array();
			} else {

				$criteria->add(SharedGroupPeer::ID_GROUP, $this->getIdGroup());

				SharedGroupPeer::addSelectColumns($criteria);
				$this->collSharedGroups = SharedGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedGroupPeer::ID_GROUP, $this->getIdGroup());

				SharedGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastSharedGroupCriteria) || !$this->lastSharedGroupCriteria->equals($criteria)) {
					$this->collSharedGroups = SharedGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSharedGroupCriteria = $criteria;
		return $this->collSharedGroups;
	}

	
	public function countSharedGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SharedGroupPeer::ID_GROUP, $this->getIdGroup());

		return SharedGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSharedGroup(SharedGroup $l)
	{
		$this->collSharedGroups[] = $l;
		$l->setGrupo($this);
	}


	
	public function getSharedGroupsJoinObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedGroups === null) {
			if ($this->isNew()) {
				$this->collSharedGroups = array();
			} else {

				$criteria->add(SharedGroupPeer::ID_GROUP, $this->getIdGroup());

				$this->collSharedGroups = SharedGroupPeer::doSelectJoinObjConcreto($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedGroupPeer::ID_GROUP, $this->getIdGroup());

			if (!isset($this->lastSharedGroupCriteria) || !$this->lastSharedGroupCriteria->equals($criteria)) {
				$this->collSharedGroups = SharedGroupPeer::doSelectJoinObjConcreto($criteria, $con);
			}
		}
		$this->lastSharedGroupCriteria = $criteria;

		return $this->collSharedGroups;
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

				$criteria->add(UserGroupPeer::ID_GROUP, $this->getIdGroup());

				UserGroupPeer::addSelectColumns($criteria);
				$this->collUserGroups = UserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserGroupPeer::ID_GROUP, $this->getIdGroup());

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

		$criteria->add(UserGroupPeer::ID_GROUP, $this->getIdGroup());

		return UserGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserGroup(UserGroup $l)
	{
		$this->collUserGroups[] = $l;
		$l->setGrupo($this);
	}


	
	public function getUserGroupsJoinUsuario($criteria = null, $con = null)
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

				$criteria->add(UserGroupPeer::ID_GROUP, $this->getIdGroup());

				$this->collUserGroups = UserGroupPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(UserGroupPeer::ID_GROUP, $this->getIdGroup());

			if (!isset($this->lastUserGroupCriteria) || !$this->lastUserGroupCriteria->equals($criteria)) {
				$this->collUserGroups = UserGroupPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastUserGroupCriteria = $criteria;

		return $this->collUserGroups;
	}

} 