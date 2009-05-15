<?php


abstract class BaseObjDigital extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_folder;


	
	protected $id_obj_concreto;


	
	protected $id_tipo_file;


	
	protected $binary_data;


	
	protected $tamanio;

	
	protected $aObjConcretoRelatedByIdUsuario;

	
	protected $aObjConcretoRelatedByIdFolder;

	
	protected $aObjConcretoRelatedByIdObjConcreto;

	
	protected $aTipoFile;

	
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

	
	public function getIdTipoFile()
	{

		return $this->id_tipo_file;
	}

	
	public function getBinaryData()
	{

		return $this->binary_data;
	}

	
	public function getTamanio()
	{

		return $this->tamanio;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = ObjDigitalPeer::ID_USUARIO;
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
			$this->modifiedColumns[] = ObjDigitalPeer::ID_FOLDER;
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
			$this->modifiedColumns[] = ObjDigitalPeer::ID_OBJ_CONCRETO;
		}

		if ($this->aObjConcretoRelatedByIdObjConcreto !== null && $this->aObjConcretoRelatedByIdObjConcreto->getIdObjConcreto() !== $v) {
			$this->aObjConcretoRelatedByIdObjConcreto = null;
		}

	} 
	
	public function setIdTipoFile($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tipo_file !== $v) {
			$this->id_tipo_file = $v;
			$this->modifiedColumns[] = ObjDigitalPeer::ID_TIPO_FILE;
		}

		if ($this->aTipoFile !== null && $this->aTipoFile->getIdTipoFile() !== $v) {
			$this->aTipoFile = null;
		}

	} 
	
	public function setBinaryData($v)
	{

								if ($v instanceof Lob && $v === $this->binary_data) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->binary_data !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Blob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->binary_data = $obj;
			$this->modifiedColumns[] = ObjDigitalPeer::BINARY_DATA;
		}

	} 
	
	public function setTamanio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tamanio !== $v) {
			$this->tamanio = $v;
			$this->modifiedColumns[] = ObjDigitalPeer::TAMANIO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getInt($startcol + 0);

			$this->id_folder = $rs->getInt($startcol + 1);

			$this->id_obj_concreto = $rs->getInt($startcol + 2);

			$this->id_tipo_file = $rs->getInt($startcol + 3);

			$this->binary_data = $rs->getBlob($startcol + 4);

			$this->tamanio = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ObjDigital object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ObjDigitalPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ObjDigitalPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ObjDigitalPeer::DATABASE_NAME);
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

			if ($this->aTipoFile !== null) {
				if ($this->aTipoFile->isModified()) {
					$affectedRows += $this->aTipoFile->save($con);
				}
				$this->setTipoFile($this->aTipoFile);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ObjDigitalPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ObjDigitalPeer::doUpdate($this, $con);
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

			if ($this->aTipoFile !== null) {
				if (!$this->aTipoFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoFile->getValidationFailures());
				}
			}


			if (($retval = ObjDigitalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ObjDigitalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIdTipoFile();
				break;
			case 4:
				return $this->getBinaryData();
				break;
			case 5:
				return $this->getTamanio();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ObjDigitalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdFolder(),
			$keys[2] => $this->getIdObjConcreto(),
			$keys[3] => $this->getIdTipoFile(),
			$keys[4] => $this->getBinaryData(),
			$keys[5] => $this->getTamanio(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ObjDigitalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIdTipoFile($value);
				break;
			case 4:
				$this->setBinaryData($value);
				break;
			case 5:
				$this->setTamanio($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ObjDigitalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdFolder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdObjConcreto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdTipoFile($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBinaryData($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTamanio($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ObjDigitalPeer::DATABASE_NAME);

		if ($this->isColumnModified(ObjDigitalPeer::ID_USUARIO)) $criteria->add(ObjDigitalPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(ObjDigitalPeer::ID_FOLDER)) $criteria->add(ObjDigitalPeer::ID_FOLDER, $this->id_folder);
		if ($this->isColumnModified(ObjDigitalPeer::ID_OBJ_CONCRETO)) $criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		if ($this->isColumnModified(ObjDigitalPeer::ID_TIPO_FILE)) $criteria->add(ObjDigitalPeer::ID_TIPO_FILE, $this->id_tipo_file);
		if ($this->isColumnModified(ObjDigitalPeer::BINARY_DATA)) $criteria->add(ObjDigitalPeer::BINARY_DATA, $this->binary_data);
		if ($this->isColumnModified(ObjDigitalPeer::TAMANIO)) $criteria->add(ObjDigitalPeer::TAMANIO, $this->tamanio);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ObjDigitalPeer::DATABASE_NAME);

		$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->id_usuario);
		$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->id_folder);
		$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIdUsuario();

		$pks[1] = $this->getIdFolder();

		$pks[2] = $this->getIdObjConcreto();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIdUsuario($keys[0]);

		$this->setIdFolder($keys[1]);

		$this->setIdObjConcreto($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdTipoFile($this->id_tipo_file);

		$copyObj->setBinaryData($this->binary_data);

		$copyObj->setTamanio($this->tamanio);


		$copyObj->setNew(true);

		$copyObj->setIdUsuario(NULL); 
		$copyObj->setIdFolder(NULL); 
		$copyObj->setIdObjConcreto(NULL); 
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
			self::$peer = new ObjDigitalPeer();
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

	
	public function setTipoFile($v)
	{


		if ($v === null) {
			$this->setIdTipoFile(NULL);
		} else {
			$this->setIdTipoFile($v->getIdTipoFile());
		}


		$this->aTipoFile = $v;
	}


	
	public function getTipoFile($con = null)
	{
		if ($this->aTipoFile === null && ($this->id_tipo_file !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseTipoFilePeer.php';

			$this->aTipoFile = TipoFilePeer::retrieveByPK($this->id_tipo_file, $con);

			
		}
		return $this->aTipoFile;
	}

} 