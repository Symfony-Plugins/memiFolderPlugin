<?php


abstract class BasePermiso extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_permiso;


	
	protected $nombre_permiso;


	
	protected $descripcionper;

	
	protected $collPermisoGrupos;

	
	protected $lastPermisoGrupoCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdPermiso()
	{

		return $this->id_permiso;
	}

	
	public function getNombrePermiso()
	{

		return $this->nombre_permiso;
	}

	
	public function getDescripcionper()
	{

		return $this->descripcionper;
	}

	
	public function setIdPermiso($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_permiso !== $v) {
			$this->id_permiso = $v;
			$this->modifiedColumns[] = PermisoPeer::ID_PERMISO;
		}

	} 
	
	public function setNombrePermiso($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_permiso !== $v) {
			$this->nombre_permiso = $v;
			$this->modifiedColumns[] = PermisoPeer::NOMBRE_PERMISO;
		}

	} 
	
	public function setDescripcionper($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcionper !== $v) {
			$this->descripcionper = $v;
			$this->modifiedColumns[] = PermisoPeer::DESCRIPCIONPER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_permiso = $rs->getInt($startcol + 0);

			$this->nombre_permiso = $rs->getString($startcol + 1);

			$this->descripcionper = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Permiso object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PermisoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PermisoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PermisoPeer::DATABASE_NAME);
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
					$pk = PermisoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdPermiso($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PermisoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPermisoGrupos !== null) {
				foreach($this->collPermisoGrupos as $referrerFK) {
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


			if (($retval = PermisoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPermisoGrupos !== null) {
					foreach($this->collPermisoGrupos as $referrerFK) {
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
		$pos = PermisoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdPermiso();
				break;
			case 1:
				return $this->getNombrePermiso();
				break;
			case 2:
				return $this->getDescripcionper();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdPermiso(),
			$keys[1] => $this->getNombrePermiso(),
			$keys[2] => $this->getDescripcionper(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PermisoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdPermiso($value);
				break;
			case 1:
				$this->setNombrePermiso($value);
				break;
			case 2:
				$this->setDescripcionper($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdPermiso($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombrePermiso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescripcionper($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PermisoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PermisoPeer::ID_PERMISO)) $criteria->add(PermisoPeer::ID_PERMISO, $this->id_permiso);
		if ($this->isColumnModified(PermisoPeer::NOMBRE_PERMISO)) $criteria->add(PermisoPeer::NOMBRE_PERMISO, $this->nombre_permiso);
		if ($this->isColumnModified(PermisoPeer::DESCRIPCIONPER)) $criteria->add(PermisoPeer::DESCRIPCIONPER, $this->descripcionper);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PermisoPeer::DATABASE_NAME);

		$criteria->add(PermisoPeer::ID_PERMISO, $this->id_permiso);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdPermiso();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdPermiso($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombrePermiso($this->nombre_permiso);

		$copyObj->setDescripcionper($this->descripcionper);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPermisoGrupos() as $relObj) {
				$copyObj->addPermisoGrupo($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdPermiso(NULL); 
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
			self::$peer = new PermisoPeer();
		}
		return self::$peer;
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

				$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

				PermisoGrupoPeer::addSelectColumns($criteria);
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

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

		$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

		return PermisoGrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPermisoGrupo(PermisoGrupo $l)
	{
		$this->collPermisoGrupos[] = $l;
		$l->setPermiso($this);
	}


	
	public function getPermisoGruposJoinRol($criteria = null, $con = null)
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

				$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

			if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastPermisoGrupoCriteria = $criteria;

		return $this->collPermisoGrupos;
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

				$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinFormulario($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->getIdPermiso());

			if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinFormulario($criteria, $con);
			}
		}
		$this->lastPermisoGrupoCriteria = $criteria;

		return $this->collPermisoGrupos;
	}

} 