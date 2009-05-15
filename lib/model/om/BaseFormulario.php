<?php


abstract class BaseFormulario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_form;


	
	protected $pagina;


	
	protected $credencial;

	
	protected $collPermisoGrupos;

	
	protected $lastPermisoGrupoCriteria = null;

	
	protected $collPermisoUsers;

	
	protected $lastPermisoUserCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdForm()
	{

		return $this->id_form;
	}

	
	public function getPagina()
	{

		return $this->pagina;
	}

	
	public function getCredencial()
	{

		return $this->credencial;
	}

	
	public function setIdForm($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_form !== $v) {
			$this->id_form = $v;
			$this->modifiedColumns[] = FormularioPeer::ID_FORM;
		}

	} 
	
	public function setPagina($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pagina !== $v) {
			$this->pagina = $v;
			$this->modifiedColumns[] = FormularioPeer::PAGINA;
		}

	} 
	
	public function setCredencial($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->credencial !== $v) {
			$this->credencial = $v;
			$this->modifiedColumns[] = FormularioPeer::CREDENCIAL;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_form = $rs->getInt($startcol + 0);

			$this->pagina = $rs->getString($startcol + 1);

			$this->credencial = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Formulario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FormularioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FormularioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FormularioPeer::DATABASE_NAME);
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
					$pk = FormularioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdForm($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FormularioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = FormularioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FormularioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdForm();
				break;
			case 1:
				return $this->getPagina();
				break;
			case 2:
				return $this->getCredencial();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FormularioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdForm(),
			$keys[1] => $this->getPagina(),
			$keys[2] => $this->getCredencial(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FormularioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdForm($value);
				break;
			case 1:
				$this->setPagina($value);
				break;
			case 2:
				$this->setCredencial($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FormularioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdForm($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPagina($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCredencial($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FormularioPeer::DATABASE_NAME);

		if ($this->isColumnModified(FormularioPeer::ID_FORM)) $criteria->add(FormularioPeer::ID_FORM, $this->id_form);
		if ($this->isColumnModified(FormularioPeer::PAGINA)) $criteria->add(FormularioPeer::PAGINA, $this->pagina);
		if ($this->isColumnModified(FormularioPeer::CREDENCIAL)) $criteria->add(FormularioPeer::CREDENCIAL, $this->credencial);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FormularioPeer::DATABASE_NAME);

		$criteria->add(FormularioPeer::ID_FORM, $this->id_form);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdForm();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdForm($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPagina($this->pagina);

		$copyObj->setCredencial($this->credencial);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPermisoGrupos() as $relObj) {
				$copyObj->addPermisoGrupo($relObj->copy($deepCopy));
			}

			foreach($this->getPermisoUsers() as $relObj) {
				$copyObj->addPermisoUser($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdForm(NULL); 
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
			self::$peer = new FormularioPeer();
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

				$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

				PermisoGrupoPeer::addSelectColumns($criteria);
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

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

		$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

		return PermisoGrupoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPermisoGrupo(PermisoGrupo $l)
	{
		$this->collPermisoGrupos[] = $l;
		$l->setFormulario($this);
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

				$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

			if (!isset($this->lastPermisoGrupoCriteria) || !$this->lastPermisoGrupoCriteria->equals($criteria)) {
				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinRol($criteria, $con);
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

				$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

				$this->collPermisoGrupos = PermisoGrupoPeer::doSelectJoinPermiso($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoGrupoPeer::ID_FORM, $this->getIdForm());

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

				$criteria->add(PermisoUserPeer::ID_FORM, $this->getIdForm());

				PermisoUserPeer::addSelectColumns($criteria);
				$this->collPermisoUsers = PermisoUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PermisoUserPeer::ID_FORM, $this->getIdForm());

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

		$criteria->add(PermisoUserPeer::ID_FORM, $this->getIdForm());

		return PermisoUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPermisoUser(PermisoUser $l)
	{
		$this->collPermisoUsers[] = $l;
		$l->setFormulario($this);
	}


	
	public function getPermisoUsersJoinRol($criteria = null, $con = null)
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

				$criteria->add(PermisoUserPeer::ID_FORM, $this->getIdForm());

				$this->collPermisoUsers = PermisoUserPeer::doSelectJoinRol($criteria, $con);
			}
		} else {
									
			$criteria->add(PermisoUserPeer::ID_FORM, $this->getIdForm());

			if (!isset($this->lastPermisoUserCriteria) || !$this->lastPermisoUserCriteria->equals($criteria)) {
				$this->collPermisoUsers = PermisoUserPeer::doSelectJoinRol($criteria, $con);
			}
		}
		$this->lastPermisoUserCriteria = $criteria;

		return $this->collPermisoUsers;
	}

} 