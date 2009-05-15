<?php


abstract class BaseSharedGroup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_obj_concreto;


	
	protected $id_group;


	
	protected $id_usuario;


	
	protected $id_folder;

	
	protected $aObjConcreto;

	
	protected $aGrupo;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdObjConcreto()
	{

		return $this->id_obj_concreto;
	}

	
	public function getIdGroup()
	{

		return $this->id_group;
	}

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdFolder()
	{

		return $this->id_folder;
	}

	
	public function setIdObjConcreto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_obj_concreto !== $v) {
			$this->id_obj_concreto = $v;
			$this->modifiedColumns[] = SharedGroupPeer::ID_OBJ_CONCRETO;
		}

		if ($this->aObjConcreto !== null && $this->aObjConcreto->getIdObjConcreto() !== $v) {
			$this->aObjConcreto = null;
		}

	} 
	
	public function setIdGroup($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_group !== $v) {
			$this->id_group = $v;
			$this->modifiedColumns[] = SharedGroupPeer::ID_GROUP;
		}

		if ($this->aGrupo !== null && $this->aGrupo->getIdGroup() !== $v) {
			$this->aGrupo = null;
		}

	} 
	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = SharedGroupPeer::ID_USUARIO;
		}

	} 
	
	public function setIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_folder !== $v) {
			$this->id_folder = $v;
			$this->modifiedColumns[] = SharedGroupPeer::ID_FOLDER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_obj_concreto = $rs->getInt($startcol + 0);

			$this->id_group = $rs->getInt($startcol + 1);

			$this->id_usuario = $rs->getInt($startcol + 2);

			$this->id_folder = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SharedGroup object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SharedGroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SharedGroupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SharedGroupPeer::DATABASE_NAME);
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

			if ($this->aGrupo !== null) {
				if ($this->aGrupo->isModified()) {
					$affectedRows += $this->aGrupo->save($con);
				}
				$this->setGrupo($this->aGrupo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SharedGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SharedGroupPeer::doUpdate($this, $con);
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

			if ($this->aGrupo !== null) {
				if (!$this->aGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGrupo->getValidationFailures());
				}
			}


			if (($retval = SharedGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SharedGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdObjConcreto();
				break;
			case 1:
				return $this->getIdGroup();
				break;
			case 2:
				return $this->getIdUsuario();
				break;
			case 3:
				return $this->getIdFolder();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SharedGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdObjConcreto(),
			$keys[1] => $this->getIdGroup(),
			$keys[2] => $this->getIdUsuario(),
			$keys[3] => $this->getIdFolder(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SharedGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdObjConcreto($value);
				break;
			case 1:
				$this->setIdGroup($value);
				break;
			case 2:
				$this->setIdUsuario($value);
				break;
			case 3:
				$this->setIdFolder($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SharedGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdObjConcreto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdGroup($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdFolder($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SharedGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(SharedGroupPeer::ID_OBJ_CONCRETO)) $criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		if ($this->isColumnModified(SharedGroupPeer::ID_GROUP)) $criteria->add(SharedGroupPeer::ID_GROUP, $this->id_group);
		if ($this->isColumnModified(SharedGroupPeer::ID_USUARIO)) $criteria->add(SharedGroupPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(SharedGroupPeer::ID_FOLDER)) $criteria->add(SharedGroupPeer::ID_FOLDER, $this->id_folder);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SharedGroupPeer::DATABASE_NAME);

		$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		$criteria->add(SharedGroupPeer::ID_GROUP, $this->id_group);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdObjConcreto();

		$pks[1] = $this->getIdGroup();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdObjConcreto($keys[0]);

		$this->setIdGroup($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setIdFolder($this->id_folder);


		$copyObj->setNew(true);

		$copyObj->setIdObjConcreto(NULL); 
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
			self::$peer = new SharedGroupPeer();
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

	
	public function setGrupo($v)
	{


		if ($v === null) {
			$this->setIdGroup(NULL);
		} else {
			$this->setIdGroup($v->getIdGroup());
		}


		$this->aGrupo = $v;
	}


	
	public function getGrupo($con = null)
	{
		if ($this->aGrupo === null && ($this->id_group !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseGrupoPeer.php';

			$this->aGrupo = GrupoPeer::retrieveByPK($this->id_group, $con);

			
		}
		return $this->aGrupo;
	}

} 