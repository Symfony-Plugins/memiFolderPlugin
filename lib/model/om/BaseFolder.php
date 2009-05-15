<?php


abstract class BaseFolder extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_folder;


	
	protected $fol_id_usuario;


	
	protected $fol_id_folder;


	
	protected $nombre_folder;


	
	protected $quote;

	
	protected $aUsuario;

	
	protected $aFolderRelatedByFolIdUsuario;

	
	protected $aFolderRelatedByFolIdFolder;

	
	protected $collFoldersRelatedByFolIdUsuario;

	
	protected $lastFolderRelatedByFolIdUsuarioCriteria = null;

	
	protected $collFoldersRelatedByFolIdFolder;

	
	protected $lastFolderRelatedByFolIdFolderCriteria = null;

	
	protected $collObjConcretosRelatedByIdUsuario;

	
	protected $lastObjConcretoRelatedByIdUsuarioCriteria = null;

	
	protected $collObjConcretosRelatedByIdFolder;

	
	protected $lastObjConcretoRelatedByIdFolderCriteria = null;

	
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

	
	public function getFolIdUsuario()
	{

		return $this->fol_id_usuario;
	}

	
	public function getFolIdFolder()
	{

		return $this->fol_id_folder;
	}

	
	public function getNombreFolder()
	{

		return $this->nombre_folder;
	}

	
	public function getQuote()
	{

		return $this->quote;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = FolderPeer::ID_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getIdUsuario() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_folder !== $v) {
			$this->id_folder = $v;
			$this->modifiedColumns[] = FolderPeer::ID_FOLDER;
		}

	} 
	
	public function setFolIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fol_id_usuario !== $v) {
			$this->fol_id_usuario = $v;
			$this->modifiedColumns[] = FolderPeer::FOL_ID_USUARIO;
		}

		if ($this->aFolderRelatedByFolIdUsuario !== null && $this->aFolderRelatedByFolIdUsuario->getIdUsuario() !== $v) {
			$this->aFolderRelatedByFolIdUsuario = null;
		}

	} 
	
	public function setFolIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fol_id_folder !== $v) {
			$this->fol_id_folder = $v;
			$this->modifiedColumns[] = FolderPeer::FOL_ID_FOLDER;
		}

		if ($this->aFolderRelatedByFolIdFolder !== null && $this->aFolderRelatedByFolIdFolder->getIdFolder() !== $v) {
			$this->aFolderRelatedByFolIdFolder = null;
		}

	} 
	
	public function setNombreFolder($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_folder !== $v) {
			$this->nombre_folder = $v;
			$this->modifiedColumns[] = FolderPeer::NOMBRE_FOLDER;
		}

	} 
	
	public function setQuote($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quote !== $v) {
			$this->quote = $v;
			$this->modifiedColumns[] = FolderPeer::QUOTE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getInt($startcol + 0);

			$this->id_folder = $rs->getInt($startcol + 1);

			$this->fol_id_usuario = $rs->getInt($startcol + 2);

			$this->fol_id_folder = $rs->getInt($startcol + 3);

			$this->nombre_folder = $rs->getString($startcol + 4);

			$this->quote = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Folder object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FolderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FolderPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FolderPeer::DATABASE_NAME);
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


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aFolderRelatedByFolIdUsuario !== null) {
				if ($this->aFolderRelatedByFolIdUsuario->isModified()) {
					$affectedRows += $this->aFolderRelatedByFolIdUsuario->save($con);
				}
				$this->setFolderRelatedByFolIdUsuario($this->aFolderRelatedByFolIdUsuario);
			}

			if ($this->aFolderRelatedByFolIdFolder !== null) {
				if ($this->aFolderRelatedByFolIdFolder->isModified()) {
					$affectedRows += $this->aFolderRelatedByFolIdFolder->save($con);
				}
				$this->setFolderRelatedByFolIdFolder($this->aFolderRelatedByFolIdFolder);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FolderPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdFolder($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FolderPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collFoldersRelatedByFolIdUsuario !== null) {
				foreach($this->collFoldersRelatedByFolIdUsuario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFoldersRelatedByFolIdFolder !== null) {
				foreach($this->collFoldersRelatedByFolIdFolder as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collObjConcretosRelatedByIdUsuario !== null) {
				foreach($this->collObjConcretosRelatedByIdUsuario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collObjConcretosRelatedByIdFolder !== null) {
				foreach($this->collObjConcretosRelatedByIdFolder as $referrerFK) {
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aFolderRelatedByFolIdUsuario !== null) {
				if (!$this->aFolderRelatedByFolIdUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFolderRelatedByFolIdUsuario->getValidationFailures());
				}
			}

			if ($this->aFolderRelatedByFolIdFolder !== null) {
				if (!$this->aFolderRelatedByFolIdFolder->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFolderRelatedByFolIdFolder->getValidationFailures());
				}
			}


			if (($retval = FolderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collObjConcretosRelatedByIdUsuario !== null) {
					foreach($this->collObjConcretosRelatedByIdUsuario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collObjConcretosRelatedByIdFolder !== null) {
					foreach($this->collObjConcretosRelatedByIdFolder as $referrerFK) {
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
		$pos = FolderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFolIdUsuario();
				break;
			case 3:
				return $this->getFolIdFolder();
				break;
			case 4:
				return $this->getNombreFolder();
				break;
			case 5:
				return $this->getQuote();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FolderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdFolder(),
			$keys[2] => $this->getFolIdUsuario(),
			$keys[3] => $this->getFolIdFolder(),
			$keys[4] => $this->getNombreFolder(),
			$keys[5] => $this->getQuote(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FolderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFolIdUsuario($value);
				break;
			case 3:
				$this->setFolIdFolder($value);
				break;
			case 4:
				$this->setNombreFolder($value);
				break;
			case 5:
				$this->setQuote($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FolderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdFolder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFolIdUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFolIdFolder($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNombreFolder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuote($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FolderPeer::DATABASE_NAME);

		if ($this->isColumnModified(FolderPeer::ID_USUARIO)) $criteria->add(FolderPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(FolderPeer::ID_FOLDER)) $criteria->add(FolderPeer::ID_FOLDER, $this->id_folder);
		if ($this->isColumnModified(FolderPeer::FOL_ID_USUARIO)) $criteria->add(FolderPeer::FOL_ID_USUARIO, $this->fol_id_usuario);
		if ($this->isColumnModified(FolderPeer::FOL_ID_FOLDER)) $criteria->add(FolderPeer::FOL_ID_FOLDER, $this->fol_id_folder);
		if ($this->isColumnModified(FolderPeer::NOMBRE_FOLDER)) $criteria->add(FolderPeer::NOMBRE_FOLDER, $this->nombre_folder);
		if ($this->isColumnModified(FolderPeer::QUOTE)) $criteria->add(FolderPeer::QUOTE, $this->quote);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FolderPeer::DATABASE_NAME);

		$criteria->add(FolderPeer::ID_FOLDER, $this->id_folder);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdFolder();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdFolder($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setFolIdUsuario($this->fol_id_usuario);

		$copyObj->setFolIdFolder($this->fol_id_folder);

		$copyObj->setNombreFolder($this->nombre_folder);

		$copyObj->setQuote($this->quote);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getFoldersRelatedByFolIdUsuario() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addFolderRelatedByFolIdUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getFoldersRelatedByFolIdFolder() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addFolderRelatedByFolIdFolder($relObj->copy($deepCopy));
			}

			foreach($this->getObjConcretosRelatedByIdUsuario() as $relObj) {
				$copyObj->addObjConcretoRelatedByIdUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getObjConcretosRelatedByIdFolder() as $relObj) {
				$copyObj->addObjConcretoRelatedByIdFolder($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIdFolder(NULL); 
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
			self::$peer = new FolderPeer();
		}
		return self::$peer;
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

	
	public function setFolderRelatedByFolIdUsuario($v)
	{


		if ($v === null) {
			$this->setFolIdUsuario(NULL);
		} else {
			$this->setFolIdUsuario($v->getIdUsuario());
		}


		$this->aFolderRelatedByFolIdUsuario = $v;
	}


	
	public function getFolderRelatedByFolIdUsuario($con = null)
	{
		if ($this->aFolderRelatedByFolIdUsuario === null && ($this->fol_id_usuario !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';

			$this->aFolderRelatedByFolIdUsuario = FolderPeer::retrieveByPK($this->fol_id_usuario, $con);

			
		}
		return $this->aFolderRelatedByFolIdUsuario;
	}

	
	public function setFolderRelatedByFolIdFolder($v)
	{


		if ($v === null) {
			$this->setFolIdFolder(NULL);
		} else {
			$this->setFolIdFolder($v->getIdFolder());
		}


		$this->aFolderRelatedByFolIdFolder = $v;
	}


	
	public function getFolderRelatedByFolIdFolder($con = null)
	{
		if ($this->aFolderRelatedByFolIdFolder === null && ($this->fol_id_folder !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';

			$this->aFolderRelatedByFolIdFolder = FolderPeer::retrieveByPK($this->fol_id_folder, $con);

			
		}
		return $this->aFolderRelatedByFolIdFolder;
	}

	
	public function initFoldersRelatedByFolIdUsuario()
	{
		if ($this->collFoldersRelatedByFolIdUsuario === null) {
			$this->collFoldersRelatedByFolIdUsuario = array();
		}
	}

	
	public function getFoldersRelatedByFolIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFoldersRelatedByFolIdUsuario === null) {
			if ($this->isNew()) {
			   $this->collFoldersRelatedByFolIdUsuario = array();
			} else {

				$criteria->add(FolderPeer::FOL_ID_USUARIO, $this->getIdUsuario());

				FolderPeer::addSelectColumns($criteria);
				$this->collFoldersRelatedByFolIdUsuario = FolderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FolderPeer::FOL_ID_USUARIO, $this->getIdUsuario());

				FolderPeer::addSelectColumns($criteria);
				if (!isset($this->lastFolderRelatedByFolIdUsuarioCriteria) || !$this->lastFolderRelatedByFolIdUsuarioCriteria->equals($criteria)) {
					$this->collFoldersRelatedByFolIdUsuario = FolderPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFolderRelatedByFolIdUsuarioCriteria = $criteria;
		return $this->collFoldersRelatedByFolIdUsuario;
	}

	
	public function countFoldersRelatedByFolIdUsuario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FolderPeer::FOL_ID_USUARIO, $this->getIdUsuario());

		return FolderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFolderRelatedByFolIdUsuario(Folder $l)
	{
		$this->collFoldersRelatedByFolIdUsuario[] = $l;
		$l->setFolderRelatedByFolIdUsuario($this);
	}


	
	public function getFoldersRelatedByFolIdUsuarioJoinUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFoldersRelatedByFolIdUsuario === null) {
			if ($this->isNew()) {
				$this->collFoldersRelatedByFolIdUsuario = array();
			} else {

				$criteria->add(FolderPeer::FOL_ID_USUARIO, $this->getIdUsuario());

				$this->collFoldersRelatedByFolIdUsuario = FolderPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(FolderPeer::FOL_ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastFolderRelatedByFolIdUsuarioCriteria) || !$this->lastFolderRelatedByFolIdUsuarioCriteria->equals($criteria)) {
				$this->collFoldersRelatedByFolIdUsuario = FolderPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastFolderRelatedByFolIdUsuarioCriteria = $criteria;

		return $this->collFoldersRelatedByFolIdUsuario;
	}

	
	public function initFoldersRelatedByFolIdFolder()
	{
		if ($this->collFoldersRelatedByFolIdFolder === null) {
			$this->collFoldersRelatedByFolIdFolder = array();
		}
	}

	
	public function getFoldersRelatedByFolIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFoldersRelatedByFolIdFolder === null) {
			if ($this->isNew()) {
			   $this->collFoldersRelatedByFolIdFolder = array();
			} else {

				$criteria->add(FolderPeer::FOL_ID_FOLDER, $this->getIdFolder());

				FolderPeer::addSelectColumns($criteria);
				$this->collFoldersRelatedByFolIdFolder = FolderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FolderPeer::FOL_ID_FOLDER, $this->getIdFolder());

				FolderPeer::addSelectColumns($criteria);
				if (!isset($this->lastFolderRelatedByFolIdFolderCriteria) || !$this->lastFolderRelatedByFolIdFolderCriteria->equals($criteria)) {
					$this->collFoldersRelatedByFolIdFolder = FolderPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFolderRelatedByFolIdFolderCriteria = $criteria;
		return $this->collFoldersRelatedByFolIdFolder;
	}

	
	public function countFoldersRelatedByFolIdFolder($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FolderPeer::FOL_ID_FOLDER, $this->getIdFolder());

		return FolderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFolderRelatedByFolIdFolder(Folder $l)
	{
		$this->collFoldersRelatedByFolIdFolder[] = $l;
		$l->setFolderRelatedByFolIdFolder($this);
	}


	
	public function getFoldersRelatedByFolIdFolderJoinUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFoldersRelatedByFolIdFolder === null) {
			if ($this->isNew()) {
				$this->collFoldersRelatedByFolIdFolder = array();
			} else {

				$criteria->add(FolderPeer::FOL_ID_FOLDER, $this->getIdFolder());

				$this->collFoldersRelatedByFolIdFolder = FolderPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(FolderPeer::FOL_ID_FOLDER, $this->getIdFolder());

			if (!isset($this->lastFolderRelatedByFolIdFolderCriteria) || !$this->lastFolderRelatedByFolIdFolderCriteria->equals($criteria)) {
				$this->collFoldersRelatedByFolIdFolder = FolderPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastFolderRelatedByFolIdFolderCriteria = $criteria;

		return $this->collFoldersRelatedByFolIdFolder;
	}

	
	public function initObjConcretosRelatedByIdUsuario()
	{
		if ($this->collObjConcretosRelatedByIdUsuario === null) {
			$this->collObjConcretosRelatedByIdUsuario = array();
		}
	}

	
	public function getObjConcretosRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretosRelatedByIdUsuario === null) {
			if ($this->isNew()) {
			   $this->collObjConcretosRelatedByIdUsuario = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getIdUsuario());

				ObjConcretoPeer::addSelectColumns($criteria);
				$this->collObjConcretosRelatedByIdUsuario = ObjConcretoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getIdUsuario());

				ObjConcretoPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjConcretoRelatedByIdUsuarioCriteria) || !$this->lastObjConcretoRelatedByIdUsuarioCriteria->equals($criteria)) {
					$this->collObjConcretosRelatedByIdUsuario = ObjConcretoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjConcretoRelatedByIdUsuarioCriteria = $criteria;
		return $this->collObjConcretosRelatedByIdUsuario;
	}

	
	public function countObjConcretosRelatedByIdUsuario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getIdUsuario());

		return ObjConcretoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjConcretoRelatedByIdUsuario(ObjConcreto $l)
	{
		$this->collObjConcretosRelatedByIdUsuario[] = $l;
		$l->setFolderRelatedByIdUsuario($this);
	}


	
	public function getObjConcretosRelatedByIdUsuarioJoinTipoObj($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretosRelatedByIdUsuario === null) {
			if ($this->isNew()) {
				$this->collObjConcretosRelatedByIdUsuario = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collObjConcretosRelatedByIdUsuario = ObjConcretoPeer::doSelectJoinTipoObj($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastObjConcretoRelatedByIdUsuarioCriteria) || !$this->lastObjConcretoRelatedByIdUsuarioCriteria->equals($criteria)) {
				$this->collObjConcretosRelatedByIdUsuario = ObjConcretoPeer::doSelectJoinTipoObj($criteria, $con);
			}
		}
		$this->lastObjConcretoRelatedByIdUsuarioCriteria = $criteria;

		return $this->collObjConcretosRelatedByIdUsuario;
	}

	
	public function initObjConcretosRelatedByIdFolder()
	{
		if ($this->collObjConcretosRelatedByIdFolder === null) {
			$this->collObjConcretosRelatedByIdFolder = array();
		}
	}

	
	public function getObjConcretosRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretosRelatedByIdFolder === null) {
			if ($this->isNew()) {
			   $this->collObjConcretosRelatedByIdFolder = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_FOLDER, $this->getIdFolder());

				ObjConcretoPeer::addSelectColumns($criteria);
				$this->collObjConcretosRelatedByIdFolder = ObjConcretoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjConcretoPeer::ID_FOLDER, $this->getIdFolder());

				ObjConcretoPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjConcretoRelatedByIdFolderCriteria) || !$this->lastObjConcretoRelatedByIdFolderCriteria->equals($criteria)) {
					$this->collObjConcretosRelatedByIdFolder = ObjConcretoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjConcretoRelatedByIdFolderCriteria = $criteria;
		return $this->collObjConcretosRelatedByIdFolder;
	}

	
	public function countObjConcretosRelatedByIdFolder($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjConcretoPeer::ID_FOLDER, $this->getIdFolder());

		return ObjConcretoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjConcretoRelatedByIdFolder(ObjConcreto $l)
	{
		$this->collObjConcretosRelatedByIdFolder[] = $l;
		$l->setFolderRelatedByIdFolder($this);
	}


	
	public function getObjConcretosRelatedByIdFolderJoinTipoObj($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjConcretoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjConcretosRelatedByIdFolder === null) {
			if ($this->isNew()) {
				$this->collObjConcretosRelatedByIdFolder = array();
			} else {

				$criteria->add(ObjConcretoPeer::ID_FOLDER, $this->getIdFolder());

				$this->collObjConcretosRelatedByIdFolder = ObjConcretoPeer::doSelectJoinTipoObj($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjConcretoPeer::ID_FOLDER, $this->getIdFolder());

			if (!isset($this->lastObjConcretoRelatedByIdFolderCriteria) || !$this->lastObjConcretoRelatedByIdFolderCriteria->equals($criteria)) {
				$this->collObjConcretosRelatedByIdFolder = ObjConcretoPeer::doSelectJoinTipoObj($criteria, $con);
			}
		}
		$this->lastObjConcretoRelatedByIdFolderCriteria = $criteria;

		return $this->collObjConcretosRelatedByIdFolder;
	}

} 