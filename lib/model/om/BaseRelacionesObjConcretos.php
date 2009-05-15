<?php


abstract class BaseRelacionesObjConcretos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_folder;


	
	protected $id_obj_concreto;


	
	protected $obj_id_usuario;


	
	protected $obj_id_folder;


	
	protected $obj_id_obj_concreto;


	
	protected $id_tiporelacion;

	
	protected $aObjConcretoRelatedByIdUsuario;

	
	protected $aObjConcretoRelatedByIdFolder;

	
	protected $aObjConcretoRelatedByIdObjConcreto;

	
	protected $aObjConcretoRelatedByObjIdUsuario;

	
	protected $aObjConcretoRelatedByObjIdFolder;

	
	protected $aObjConcretoRelatedByObjIdObjConcreto;

	
	protected $aTipoRelacion;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUsuario()
	{

		return $this->id_usuario;
	}

	
	public function getIdFolder()
	{

		return $this->id_folder;
	}

	
	public function getIdObjConcreto()
	{

		return $this->id_obj_concreto;
	}

	
	public function getObjIdUsuario()
	{

		return $this->obj_id_usuario;
	}

	
	public function getObjIdFolder()
	{

		return $this->obj_id_folder;
	}

	
	public function getObjIdObjConcreto()
	{

		return $this->obj_id_obj_concreto;
	}

	
	public function getIdTiporelacion()
	{

		return $this->id_tiporelacion;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::ID_USUARIO;
		}

		if ($this->aObjConcretoRelatedByIdUsuario !== null && $this->aObjConcretoRelatedByIdUsuario->getIdUsuario() !== $v) {
			$this->aObjConcretoRelatedByIdUsuario = null;
		}

	} 
	
	public function setIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_folder !== $v) {
			$this->id_folder = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::ID_FOLDER;
		}

		if ($this->aObjConcretoRelatedByIdFolder !== null && $this->aObjConcretoRelatedByIdFolder->getIdFolder() !== $v) {
			$this->aObjConcretoRelatedByIdFolder = null;
		}

	} 
	
	public function setIdObjConcreto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_obj_concreto !== $v) {
			$this->id_obj_concreto = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::ID_OBJ_CONCRETO;
		}

		if ($this->aObjConcretoRelatedByIdObjConcreto !== null && $this->aObjConcretoRelatedByIdObjConcreto->getIdObjConcreto() !== $v) {
			$this->aObjConcretoRelatedByIdObjConcreto = null;
		}

	} 
	
	public function setObjIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->obj_id_usuario !== $v) {
			$this->obj_id_usuario = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::OBJ_ID_USUARIO;
		}

		if ($this->aObjConcretoRelatedByObjIdUsuario !== null && $this->aObjConcretoRelatedByObjIdUsuario->getIdUsuario() !== $v) {
			$this->aObjConcretoRelatedByObjIdUsuario = null;
		}

	} 
	
	public function setObjIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->obj_id_folder !== $v) {
			$this->obj_id_folder = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::OBJ_ID_FOLDER;
		}

		if ($this->aObjConcretoRelatedByObjIdFolder !== null && $this->aObjConcretoRelatedByObjIdFolder->getIdFolder() !== $v) {
			$this->aObjConcretoRelatedByObjIdFolder = null;
		}

	} 
	
	public function setObjIdObjConcreto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->obj_id_obj_concreto !== $v) {
			$this->obj_id_obj_concreto = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO;
		}

		if ($this->aObjConcretoRelatedByObjIdObjConcreto !== null && $this->aObjConcretoRelatedByObjIdObjConcreto->getIdObjConcreto() !== $v) {
			$this->aObjConcretoRelatedByObjIdObjConcreto = null;
		}

	} 
	
	public function setIdTiporelacion($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tiporelacion !== $v) {
			$this->id_tiporelacion = $v;
			$this->modifiedColumns[] = RelacionesObjConcretosPeer::ID_TIPORELACION;
		}

		if ($this->aTipoRelacion !== null && $this->aTipoRelacion->getIdTiporelacion() !== $v) {
			$this->aTipoRelacion = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getInt($startcol + 0);

			$this->id_folder = $rs->getInt($startcol + 1);

			$this->id_obj_concreto = $rs->getInt($startcol + 2);

			$this->obj_id_usuario = $rs->getInt($startcol + 3);

			$this->obj_id_folder = $rs->getInt($startcol + 4);

			$this->obj_id_obj_concreto = $rs->getInt($startcol + 5);

			$this->id_tiporelacion = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RelacionesObjConcretos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RelacionesObjConcretosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RelacionesObjConcretosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RelacionesObjConcretosPeer::DATABASE_NAME);
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


												
			if ($this->aObjConcretoRelatedByIdUsuario !== null) {
				if ($this->aObjConcretoRelatedByIdUsuario->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByIdUsuario->save($con);
				}
				$this->setObjConcretoRelatedByIdUsuario($this->aObjConcretoRelatedByIdUsuario);
			}

			if ($this->aObjConcretoRelatedByIdFolder !== null) {
				if ($this->aObjConcretoRelatedByIdFolder->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByIdFolder->save($con);
				}
				$this->setObjConcretoRelatedByIdFolder($this->aObjConcretoRelatedByIdFolder);
			}

			if ($this->aObjConcretoRelatedByIdObjConcreto !== null) {
				if ($this->aObjConcretoRelatedByIdObjConcreto->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByIdObjConcreto->save($con);
				}
				$this->setObjConcretoRelatedByIdObjConcreto($this->aObjConcretoRelatedByIdObjConcreto);
			}

			if ($this->aObjConcretoRelatedByObjIdUsuario !== null) {
				if ($this->aObjConcretoRelatedByObjIdUsuario->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByObjIdUsuario->save($con);
				}
				$this->setObjConcretoRelatedByObjIdUsuario($this->aObjConcretoRelatedByObjIdUsuario);
			}

			if ($this->aObjConcretoRelatedByObjIdFolder !== null) {
				if ($this->aObjConcretoRelatedByObjIdFolder->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByObjIdFolder->save($con);
				}
				$this->setObjConcretoRelatedByObjIdFolder($this->aObjConcretoRelatedByObjIdFolder);
			}

			if ($this->aObjConcretoRelatedByObjIdObjConcreto !== null) {
				if ($this->aObjConcretoRelatedByObjIdObjConcreto->isModified()) {
					$affectedRows += $this->aObjConcretoRelatedByObjIdObjConcreto->save($con);
				}
				$this->setObjConcretoRelatedByObjIdObjConcreto($this->aObjConcretoRelatedByObjIdObjConcreto);
			}

			if ($this->aTipoRelacion !== null) {
				if ($this->aTipoRelacion->isModified()) {
					$affectedRows += $this->aTipoRelacion->save($con);
				}
				$this->setTipoRelacion($this->aTipoRelacion);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RelacionesObjConcretosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RelacionesObjConcretosPeer::doUpdate($this, $con);
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


												
			if ($this->aObjConcretoRelatedByIdUsuario !== null) {
				if (!$this->aObjConcretoRelatedByIdUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByIdUsuario->getValidationFailures());
				}
			}

			if ($this->aObjConcretoRelatedByIdFolder !== null) {
				if (!$this->aObjConcretoRelatedByIdFolder->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByIdFolder->getValidationFailures());
				}
			}

			if ($this->aObjConcretoRelatedByIdObjConcreto !== null) {
				if (!$this->aObjConcretoRelatedByIdObjConcreto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByIdObjConcreto->getValidationFailures());
				}
			}

			if ($this->aObjConcretoRelatedByObjIdUsuario !== null) {
				if (!$this->aObjConcretoRelatedByObjIdUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByObjIdUsuario->getValidationFailures());
				}
			}

			if ($this->aObjConcretoRelatedByObjIdFolder !== null) {
				if (!$this->aObjConcretoRelatedByObjIdFolder->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByObjIdFolder->getValidationFailures());
				}
			}

			if ($this->aObjConcretoRelatedByObjIdObjConcreto !== null) {
				if (!$this->aObjConcretoRelatedByObjIdObjConcreto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aObjConcretoRelatedByObjIdObjConcreto->getValidationFailures());
				}
			}

			if ($this->aTipoRelacion !== null) {
				if (!$this->aTipoRelacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRelacion->getValidationFailures());
				}
			}


			if (($retval = RelacionesObjConcretosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RelacionesObjConcretosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUsuario();
				break;
			case 1:
				return $this->getIdFolder();
				break;
			case 2:
				return $this->getIdObjConcreto();
				break;
			case 3:
				return $this->getObjIdUsuario();
				break;
			case 4:
				return $this->getObjIdFolder();
				break;
			case 5:
				return $this->getObjIdObjConcreto();
				break;
			case 6:
				return $this->getIdTiporelacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RelacionesObjConcretosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdFolder(),
			$keys[2] => $this->getIdObjConcreto(),
			$keys[3] => $this->getObjIdUsuario(),
			$keys[4] => $this->getObjIdFolder(),
			$keys[5] => $this->getObjIdObjConcreto(),
			$keys[6] => $this->getIdTiporelacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RelacionesObjConcretosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUsuario($value);
				break;
			case 1:
				$this->setIdFolder($value);
				break;
			case 2:
				$this->setIdObjConcreto($value);
				break;
			case 3:
				$this->setObjIdUsuario($value);
				break;
			case 4:
				$this->setObjIdFolder($value);
				break;
			case 5:
				$this->setObjIdObjConcreto($value);
				break;
			case 6:
				$this->setIdTiporelacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RelacionesObjConcretosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdFolder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdObjConcreto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjIdUsuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setObjIdFolder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setObjIdObjConcreto($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIdTiporelacion($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RelacionesObjConcretosPeer::DATABASE_NAME);

		if ($this->isColumnModified(RelacionesObjConcretosPeer::ID_USUARIO)) $criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::ID_FOLDER)) $criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->id_folder);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO)) $criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::OBJ_ID_USUARIO)) $criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->obj_id_usuario);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::OBJ_ID_FOLDER)) $criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->obj_id_folder);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO)) $criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->obj_id_obj_concreto);
		if ($this->isColumnModified(RelacionesObjConcretosPeer::ID_TIPORELACION)) $criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, $this->id_tiporelacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RelacionesObjConcretosPeer::DATABASE_NAME);

		$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->id_folder);
		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->obj_id_usuario);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->obj_id_folder);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->obj_id_obj_concreto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdFolder();

		$pks[2] = $this->getIdObjConcreto();

		$pks[3] = $this->getObjIdUsuario();

		$pks[4] = $this->getObjIdFolder();

		$pks[5] = $this->getObjIdObjConcreto();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdFolder($keys[1]);

		$this->setIdObjConcreto($keys[2]);

		$this->setObjIdUsuario($keys[3]);

		$this->setObjIdFolder($keys[4]);

		$this->setObjIdObjConcreto($keys[5]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdTiporelacion($this->id_tiporelacion);


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdFolder(NULL); 
		$copyObj->setIdObjConcreto(NULL); 
		$copyObj->setObjIdUsuario(NULL); 
		$copyObj->setObjIdFolder(NULL); 
		$copyObj->setObjIdObjConcreto(NULL); 
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
			self::$peer = new RelacionesObjConcretosPeer();
		}
		return self::$peer;
	}

	
	public function setObjConcretoRelatedByIdUsuario($v)
	{


		if ($v === null) {
			$this->setIdUsuario(NULL);
		} else {
			$this->setIdUsuario($v->getIdUsuario());
		}


		$this->aObjConcretoRelatedByIdUsuario = $v;
	}


	
	public function getObjConcretoRelatedByIdUsuario($con = null)
	{
		if ($this->aObjConcretoRelatedByIdUsuario === null && ($this->id_usuario !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByIdUsuario = ObjConcretoPeer::retrieveByPK($this->id_usuario, $con);

			
		}
		return $this->aObjConcretoRelatedByIdUsuario;
	}

	
	public function setObjConcretoRelatedByIdFolder($v)
	{


		if ($v === null) {
			$this->setIdFolder(NULL);
		} else {
			$this->setIdFolder($v->getIdFolder());
		}


		$this->aObjConcretoRelatedByIdFolder = $v;
	}


	
	public function getObjConcretoRelatedByIdFolder($con = null)
	{
		if ($this->aObjConcretoRelatedByIdFolder === null && ($this->id_folder !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByIdFolder = ObjConcretoPeer::retrieveByPK($this->id_folder, $con);

			
		}
		return $this->aObjConcretoRelatedByIdFolder;
	}

	
	public function setObjConcretoRelatedByIdObjConcreto($v)
	{


		if ($v === null) {
			$this->setIdObjConcreto(NULL);
		} else {
			$this->setIdObjConcreto($v->getIdObjConcreto());
		}


		$this->aObjConcretoRelatedByIdObjConcreto = $v;
	}


	
	public function getObjConcretoRelatedByIdObjConcreto($con = null)
	{
		if ($this->aObjConcretoRelatedByIdObjConcreto === null && ($this->id_obj_concreto !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByIdObjConcreto = ObjConcretoPeer::retrieveByPK($this->id_obj_concreto, $con);

			
		}
		return $this->aObjConcretoRelatedByIdObjConcreto;
	}

	
	public function setObjConcretoRelatedByObjIdUsuario($v)
	{


		if ($v === null) {
			$this->setObjIdUsuario(NULL);
		} else {
			$this->setObjIdUsuario($v->getIdUsuario());
		}


		$this->aObjConcretoRelatedByObjIdUsuario = $v;
	}


	
	public function getObjConcretoRelatedByObjIdUsuario($con = null)
	{
		if ($this->aObjConcretoRelatedByObjIdUsuario === null && ($this->obj_id_usuario !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByObjIdUsuario = ObjConcretoPeer::retrieveByPK($this->obj_id_usuario, $con);

			
		}
		return $this->aObjConcretoRelatedByObjIdUsuario;
	}

	
	public function setObjConcretoRelatedByObjIdFolder($v)
	{


		if ($v === null) {
			$this->setObjIdFolder(NULL);
		} else {
			$this->setObjIdFolder($v->getIdFolder());
		}


		$this->aObjConcretoRelatedByObjIdFolder = $v;
	}


	
	public function getObjConcretoRelatedByObjIdFolder($con = null)
	{
		if ($this->aObjConcretoRelatedByObjIdFolder === null && ($this->obj_id_folder !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByObjIdFolder = ObjConcretoPeer::retrieveByPK($this->obj_id_folder, $con);

			
		}
		return $this->aObjConcretoRelatedByObjIdFolder;
	}

	
	public function setObjConcretoRelatedByObjIdObjConcreto($v)
	{


		if ($v === null) {
			$this->setObjIdObjConcreto(NULL);
		} else {
			$this->setObjIdObjConcreto($v->getIdObjConcreto());
		}


		$this->aObjConcretoRelatedByObjIdObjConcreto = $v;
	}


	
	public function getObjConcretoRelatedByObjIdObjConcreto($con = null)
	{
		if ($this->aObjConcretoRelatedByObjIdObjConcreto === null && ($this->obj_id_obj_concreto !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';

			$this->aObjConcretoRelatedByObjIdObjConcreto = ObjConcretoPeer::retrieveByPK($this->obj_id_obj_concreto, $con);

			
		}
		return $this->aObjConcretoRelatedByObjIdObjConcreto;
	}

	
	public function setTipoRelacion($v)
	{


		if ($v === null) {
			$this->setIdTiporelacion(NULL);
		} else {
			$this->setIdTiporelacion($v->getIdTiporelacion());
		}


		$this->aTipoRelacion = $v;
	}


	
	public function getTipoRelacion($con = null)
	{
		if ($this->aTipoRelacion === null && ($this->id_tiporelacion !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseTipoRelacionPeer.php';

			$this->aTipoRelacion = TipoRelacionPeer::retrieveByPK($this->id_tiporelacion, $con);

			
		}
		return $this->aTipoRelacion;
	}

} 