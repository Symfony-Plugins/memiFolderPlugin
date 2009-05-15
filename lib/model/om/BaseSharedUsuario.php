<?php


abstract class BaseSharedUsuario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_folder;


	
	protected $id_obj_concreto;


	
	protected $id_usuario;

	
	protected $aObjConcreto;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdFolder()
	{

		return $this->id_folder;
	}

	
	public function getIdObjConcreto()
	{

		return $this->id_obj_concreto;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function setIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_folder !== $v) {
			$this->id_folder = $v;
			$this->modifiedColumns[] = SharedUsuarioPeer::ID_FOLDER;
		}

	} 
	
	public function setIdObjConcreto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_obj_concreto !== $v) {
			$this->id_obj_concreto = $v;
			$this->modifiedColumns[] = SharedUsuarioPeer::ID_OBJ_CONCRETO;
		}

		if ($this->aObjConcreto !== null && $this->aObjConcreto->getIdObjConcreto() !== $v) {
			$this->aObjConcreto = null;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = SharedUsuarioPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getIdUsuario() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_folder = $rs->getInt($startcol + 0);

			$this->id_obj_concreto = $rs->getInt($startcol + 1);

			$this->id_usuario = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SharedUsuario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SharedUsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SharedUsuarioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SharedUsuarioPeer::DATABASE_NAME);
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


												
			if ($this->aObjConcreto !== null) {
				if ($this->aObjConcreto->isModified()) {
					$affectedRows += $this->aObjConcreto->save($con);
				}
				$this->setObjConcreto($this->aObjConcreto);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SharedUsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SharedUsuarioPeer::doUpdate($this, $con);
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


												
			if ($this->aObjConcreto !== null) {
				if (!$this->aObjConcreto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcreto->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = SharedUsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SharedUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdFolder();
				break;
			case 1:
				return $this->getIdObjConcreto();
				break;
			case 2:
				return $this->getIdUsuario();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SharedUsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdFolder(),
			$keys[1] => $this->getIdObjConcreto(),
			$keys[2] => $this->getIdUsuario(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SharedUsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdFolder($value);
				break;
			case 1:
				$this->setIdObjConcreto($value);
				break;
			case 2:
				$this->setIdUsuario($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SharedUsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdFolder($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdObjConcreto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SharedUsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(SharedUsuarioPeer::ID_FOLDER)) $criteria->add(SharedUsuarioPeer::ID_FOLDER, $this->id_folder);
		if ($this->isColumnModified(SharedUsuarioPeer::ID_OBJ_CONCRETO)) $criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		if ($this->isColumnModified(SharedUsuarioPeer::ID_USUARIO)) $criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->id_usuario);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SharedUsuarioPeer::DATABASE_NAME);

		$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		$criteria->add(SharedUsuarioPeer::ID_USUARIO, $this->id_usuario);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdObjConcreto();

		$pks[1] = $this->getIdUsuario();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdObjConcreto($keys[0]);

		$this->setIdUsuario($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdFolder($this->id_folder);


		$copyObj->setNew(true);

		$copyObj->setIdObjConcreto(NULL); 
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
			self::$peer = new SharedUsuarioPeer();
		}
		return self::$peer;
	}

	
	public function setObjConcreto($v)
	{


		if ($v === null) {
			$this->setIdObjConcreto(NULL);
		} else {
			$this->setIdObjConcreto($v->getIdObjConcreto());
		}


		$this->aObjConcreto = $v;
	}


	
	public function getObjConcreto($con = null)
	{
		if ($this->aObjConcreto === null && ($this->id_obj_concreto !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcreto = ObjConcretoPeer::retrieveByPK($this->id_obj_concreto, $con);

			
		}
		return $this->aObjConcreto;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setIdUsuario(NULL);
		} else {
			$this->setIdUsuario($v->getIdUsuario());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && ($this->id_usuario !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->id_usuario, $con);

			
		}
		return $this->aUsuario;
	}

} 