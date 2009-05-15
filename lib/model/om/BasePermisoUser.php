<?php


abstract class BasePermisoUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_rol;


	
	protected $id_form;

	
	protected $aRol;

	
	protected $aFormulario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdRol()
	{

		return $this->id_rol;
	}

	
	public function getIdForm()
	{

		return $this->id_form;
	}

	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = PermisoUserPeer::ID_ROL;
		}

		if ($this->aRol !== null && $this->aRol->getIdRol() !== $v) {
			$this->aRol = null;
		}

	} 
	
	public function setIdForm($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_form !== $v) {
			$this->id_form = $v;
			$this->modifiedColumns[] = PermisoUserPeer::ID_FORM;
		}

		if ($this->aFormulario !== null && $this->aFormulario->getIdForm() !== $v) {
			$this->aFormulario = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_rol = $rs->getInt($startcol + 0);

			$this->id_form = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PermisoUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PermisoUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PermisoUserPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PermisoUserPeer::DATABASE_NAME);
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

			if ($this->aFormulario !== null) {
				if ($this->aFormulario->isModified()) {
					$affectedRows += $this->aFormulario->save($con);
				}
				$this->setFormulario($this->aFormulario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PermisoUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PermisoUserPeer::doUpdate($this, $con);
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


												
			if ($this->aRol !== null) {
				if (!$this->aRol->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRol->getValidationFailures());
				}
			}

			if ($this->aFormulario !== null) {
				if (!$this->aFormulario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFormulario->getValidationFailures());
				}
			}


			if (($retval = PermisoUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PermisoUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdRol();
				break;
			case 1:
				return $this->getIdForm();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdRol(),
			$keys[1] => $this->getIdForm(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PermisoUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdRol($value);
				break;
			case 1:
				$this->setIdForm($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdRol($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdForm($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PermisoUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(PermisoUserPeer::ID_ROL)) $criteria->add(PermisoUserPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(PermisoUserPeer::ID_FORM)) $criteria->add(PermisoUserPeer::ID_FORM, $this->id_form);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PermisoUserPeer::DATABASE_NAME);

		$criteria->add(PermisoUserPeer::ID_ROL, $this->id_rol);
		$criteria->add(PermisoUserPeer::ID_FORM, $this->id_form);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdRol();

		$pks[1] = $this->getIdForm();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdRol($keys[0]);

		$this->setIdForm($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setIdRol(NULL); 
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
			self::$peer = new PermisoUserPeer();
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

	
	public function setFormulario($v)
	{


		if ($v === null) {
			$this->setIdForm(NULL);
		} else {
			$this->setIdForm($v->getIdForm());
		}


		$this->aFormulario = $v;
	}


	
	public function getFormulario($con = null)
	{
		if ($this->aFormulario === null && ($this->id_form !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFormularioPeer.php';

			$this->aFormulario = FormularioPeer::retrieveByPK($this->id_form, $con);

			
		}
		return $this->aFormulario;
	}

} 