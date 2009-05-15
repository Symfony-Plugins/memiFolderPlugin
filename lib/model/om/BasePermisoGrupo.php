<?php


abstract class BasePermisoGrupo extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_rol;


	
	protected $id_form;


	
	protected $id_permiso;

	
	protected $aRol;

	
	protected $aFormulario;

	
	protected $aPermiso;

	
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

	
	public function getIdPermiso()
	{

		return $this->id_permiso;
	}

	
	public function setIdRol($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_rol !== $v) {
			$this->id_rol = $v;
			$this->modifiedColumns[] = PermisoGrupoPeer::ID_ROL;
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
			$this->modifiedColumns[] = PermisoGrupoPeer::ID_FORM;
		}

		if ($this->aFormulario !== null && $this->aFormulario->getIdForm() !== $v) {
			$this->aFormulario = null;
		}

	} 
	
	public function setIdPermiso($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_permiso !== $v) {
			$this->id_permiso = $v;
			$this->modifiedColumns[] = PermisoGrupoPeer::ID_PERMISO;
		}

		if ($this->aPermiso !== null && $this->aPermiso->getIdPermiso() !== $v) {
			$this->aPermiso = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_rol = $rs->getInt($startcol + 0);

			$this->id_form = $rs->getInt($startcol + 1);

			$this->id_permiso = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PermisoGrupo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PermisoGrupoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PermisoGrupoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PermisoGrupoPeer::DATABASE_NAME);
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

			if ($this->aPermiso !== null) {
				if ($this->aPermiso->isModified()) {
					$affectedRows += $this->aPermiso->save($con);
				}
				$this->setPermiso($this->aPermiso);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PermisoGrupoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PermisoGrupoPeer::doUpdate($this, $con);
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

			if ($this->aPermiso !== null) {
				if (!$this->aPermiso->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPermiso->getValidationFailures());
				}
			}


			if (($retval = PermisoGrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PermisoGrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				return $this->getIdPermiso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoGrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdRol(),
			$keys[1] => $this->getIdForm(),
			$keys[2] => $this->getIdPermiso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PermisoGrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 2:
				$this->setIdPermiso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PermisoGrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdRol($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdForm($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdPermiso($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PermisoGrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PermisoGrupoPeer::ID_ROL)) $criteria->add(PermisoGrupoPeer::ID_ROL, $this->id_rol);
		if ($this->isColumnModified(PermisoGrupoPeer::ID_FORM)) $criteria->add(PermisoGrupoPeer::ID_FORM, $this->id_form);
		if ($this->isColumnModified(PermisoGrupoPeer::ID_PERMISO)) $criteria->add(PermisoGrupoPeer::ID_PERMISO, $this->id_permiso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PermisoGrupoPeer::DATABASE_NAME);

		$criteria->add(PermisoGrupoPeer::ID_ROL, $this->id_rol);
		$criteria->add(PermisoGrupoPeer::ID_FORM, $this->id_form);

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

		$copyObj->setIdPermiso($this->id_permiso);


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
			self::$peer = new PermisoGrupoPeer();
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

	
	public function setPermiso($v)
	{


		if ($v === null) {
			$this->setIdPermiso(NULL);
		} else {
			$this->setIdPermiso($v->getIdPermiso());
		}


		$this->aPermiso = $v;
	}


	
	public function getPermiso($con = null)
	{
		if ($this->aPermiso === null && ($this->id_permiso !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BasePermisoPeer.php';

			$this->aPermiso = PermisoPeer::retrieveByPK($this->id_permiso, $con);

			
		}
		return $this->aPermiso;
	}

} 