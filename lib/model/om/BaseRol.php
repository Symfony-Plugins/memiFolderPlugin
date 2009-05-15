<?php


abstract class BaseRol extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_rol;


	
	protected $nombre;

	
	protected $collGrupos;

	
	protected $lastGrupoCriteria = null;

	
	protected $collPermisoGrupos;

	
	protected $lastPermisoGrupoCriteria = null;

	
	protected $collPermisoUsers;

	
	protected $lastPermisoUserCriteria = null;

	
	protected $collUsuarios;

	
	protected $lastUsuarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdRol()
	{

		return $this->id_rol;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = RolPeer::ID_ROL;
		}

	} 
	
	public function setNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = RolPeer::NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_rol = $rs->getInt($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rol object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RolPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
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
					$pk = RolPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdRol($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RolPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collGrupos !== null) {
				foreach($this->collGrupos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPermisoGrupos !== null) {
				foreach($this->collPermisoGrupos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPermisoUsers !== null) {
				foreach($this->collPermisoUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarios !== null) {
				foreach($this->collUsuarios as $referrerFK) {
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


			if (($retval = RolPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGrupos !== null) {
					foreach($this->collGrupos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPermisoGrupos !== null) {
					foreach($this->collPermisoGrupos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPermisoUsers !== null) {
					foreach($this->collPermisoUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarios !== null) {
					foreach($this->collUsuarios as $referrerFK) {
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
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdRol();
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
		$keys = RolPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdRol(),
			$keys[1] => $this->getNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdRol($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdRol($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		if ($this->isColumnModified(RolPeer::ID_ROL)) $criteria->add(RolPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(RolPeer::NOMBRE)) $criteria->add(RolPeer::NOMBRE, $this->nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		$criteria->add(RolPeer::ID_ROL, $this->id_rol);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdRol();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdRol($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombre($this->nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getGrupos() as $relObj) {
				$copyObj->addGrupo($relObj->copy($deepCopy));
			}

			foreach($this->getPermisoGrupos() as $relObj) {
				$copyObj->addPermisoGrupo($relObj->copy($deepCopy));
			}

			foreach($this->getPermisoUsers() as $relObj) {
				$copyObj->addPermisoUser($relObj->copy($deepCopy));
			}

			foreach($this->getUsuarios() as $relObj) {
				$copyObj->addUsuario($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdRol(NULL); 
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
			self::$peer = new RolPeer();
		}
		return self::$peer;
	}

	
	public function initGrupos()
	{
		if ($this->collGrupos === null) {
			$this->collGrupos = array();
		}
	}

	
	public function getGrupos($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupos === null) {
			if ($this->isNew()) {
			   $this->collGrupos = array();
			} else {

				$criteria->add(GrupoPeer::ID_ROL, $this->getIdRol());

				GrupoPeer::addSelectColumns($criteria);
				$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GrupoPeer::ID_ROL, $this->getIdRol());

				GrupoPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoCriteria) || !$this->lastGrupoCriteria->equals($criteria)) {
					$this->collGrupos = GrupoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoCriteria = $criteria;
		return $this->collGrupos;
	}

	
	public function countGrupos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GrupoPeer::ID_ROL, $this->getIdRol());

		return GrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGrupo(Grupo $l)
	{
		$this->collGrupos[] = $l;
		$l->setRol($this);
	}

	
	public function initPermisoGrupos()
	{
		if ($this->collPermisoGrupos === null) {
			$this->collPermisoGrupos = array();
		}
	}

	
	public function getPermisoGrupos($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermisoGrupos === null) {
			if ($this->isNew()) {
			   $this->collPermisoGrupos = array();
			} else {

				$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

				PermisoGrupoPeer::addSelectColumns($criteria);
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

				PermisoGrupoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
					$this->collPermisoGrupos = PermisoGrupoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPermisoGrupoCriteria = $criteria;
		return $this->collPermisoGrupos;
	}

	
	public function countPermisoGrupos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

		return PermisoGrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPermisoGrupo(PermisoGrupo $l)
	{
		$this->collPermisoGrupos[] = $l;
		$l->setRol($this);
	}


	
	public function getPermisoGruposJoinFormulario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermisoGrupos === null) {
			if ($this->isNew()) {
				$this->collPermisoGrupos = array();
			} else {

				$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinFormulario($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

			if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinFormulario($criteria, $con);
			}
		}
		$this->lastPermisoGrupoCriteria = $criteria;

		return $this->collPermisoGrupos;
	}


	
	public function getPermisoGruposJoinPermiso($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoGrupoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermisoGrupos === null) {
			if ($this->isNew()) {
				$this->collPermisoGrupos = array();
			} else {

				$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinPermiso($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_ROL, $this->getIdRol());

			if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinPermiso($criteria, $con);
			}
		}
		$this->lastPermisoGrupoCriteria = $criteria;

		return $this->collPermisoGrupos;
	}

	
	public function initPermisoUsers()
	{
		if ($this->collPermisoUsers === null) {
			$this->collPermisoUsers = array();
		}
	}

	
	public function getPermisoUsers($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermisoUsers === null) {
			if ($this->isNew()) {
			   $this->collPermisoUsers = array();
			} else {

				$criteria->add(PermisoUserPeer::ID_ROL, $this->getIdRol());

				PermisoUserPeer::addSelectColumns($criteria);
				$this->collPermisoUsers = PermisoUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PermisoUserPeer::ID_ROL, $this->getIdRol());

				PermisoUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastPermisoUserCriteria) || !$this->lastPermisoUserCriteria->equals($criteria)) {
					$this->collPermisoUsers = PermisoUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPermisoUserCriteria = $criteria;
		return $this->collPermisoUsers;
	}

	
	public function countPermisoUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PermisoUserPeer::ID_ROL, $this->getIdRol());

		return PermisoUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPermisoUser(PermisoUser $l)
	{
		$this->collPermisoUsers[] = $l;
		$l->setRol($this);
	}


	
	public function getPermisoUsersJoinFormulario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPermisoUsers === null) {
			if ($this->isNew()) {
				$this->collPermisoUsers = array();
			} else {

				$criteria->add(PermisoUserPeer::ID_ROL, $this->getIdRol());

				$this->collPermisoUsers = PermisoUserPeer::doSelectJoinFormulario($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoUserPeer::ID_ROL, $this->getIdRol());

			if (!isset($this->lastPermisoUserCriteria) || !$this->lastPermisoUserCriteria->equals($criteria)) {
				$this->collPermisoUsers = PermisoUserPeer::doSelectJoinFormulario($criteria, $con);
			}
		}
		$this->lastPermisoUserCriteria = $criteria;

		return $this->collPermisoUsers;
	}

	
	public function initUsuarios()
	{
		if ($this->collUsuarios === null) {
			$this->collUsuarios = array();
		}
	}

	
	public function getUsuarios($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios === null) {
			if ($this->isNew()) {
			   $this->collUsuarios = array();
			} else {

				$criteria->add(UsuarioPeer::ID_ROL, $this->getIdRol());

				UsuarioPeer::addSelectColumns($criteria);
				$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPeer::ID_ROL, $this->getIdRol());

				UsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioCriteria) || !$this->lastUsuarioCriteria->equals($criteria)) {
					$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioCriteria = $criteria;
		return $this->collUsuarios;
	}

	
	public function countUsuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UsuarioPeer::ID_ROL, $this->getIdRol());

		return UsuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuario(Usuario $l)
	{
		$this->collUsuarios[] = $l;
		$l->setRol($this);
	}

} 