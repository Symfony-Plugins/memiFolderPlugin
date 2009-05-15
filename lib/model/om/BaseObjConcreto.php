<?php


abstract class BaseObjConcreto extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_usuario;


	
	protected $id_folder;


	
	protected $id_obj_concreto;


	
	protected $id_tipo_obj;


	
	protected $nombre_obj;


	
	protected $is_digital;


	
	protected $descripcion;


	
	protected $created_at;


	
	protected $texto;


	
	protected $texto_tsv;

	
	protected $aFolderRelatedByIdUsuario;

	
	protected $aFolderRelatedByIdFolder;

	
	protected $aTipoObj;

	
	protected $collObjDigitalsRelatedByIdUsuario;

	
	protected $lastObjDigitalRelatedByIdUsuarioCriteria = null;

	
	protected $collObjDigitalsRelatedByIdFolder;

	
	protected $lastObjDigitalRelatedByIdFolderCriteria = null;

	
	protected $collObjDigitalsRelatedByIdObjConcreto;

	
	protected $lastObjDigitalRelatedByIdObjConcretoCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByIdUsuario;

	
	protected $lastRelacionesObjConcretosRelatedByIdUsuarioCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByIdFolder;

	
	protected $lastRelacionesObjConcretosRelatedByIdFolderCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByIdObjConcreto;

	
	protected $lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByObjIdUsuario;

	
	protected $lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByObjIdFolder;

	
	protected $lastRelacionesObjConcretosRelatedByObjIdFolderCriteria = null;

	
	protected $collRelacionesObjConcretossRelatedByObjIdObjConcreto;

	
	protected $lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria = null;

	
	protected $collSharedGroups;

	
	protected $lastSharedGroupCriteria = null;

	
	protected $collSharedUsuarios;

	
	protected $lastSharedUsuarioCriteria = null;

	
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

	
	public function getIdTipoObj()
	{

		return $this->id_tipo_obj;
	}

	
	public function getNombreObj()
	{

		return $this->nombre_obj;
	}

	
	public function getIsDigital()
	{

		return $this->is_digital;
	}

	
	public function getDescripcion()
	{

		return $this->descripcion;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTexto()
	{

		return $this->texto;
	}

	
	public function getTextoTsv()
	{

		return $this->texto_tsv;
	}

	
	public function setIdUsuario($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_usuario !== $v) {
			$this->id_usuario = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::ID_USUARIO;
		}

		if ($this->aFolderRelatedByIdUsuario !== null && $this->aFolderRelatedByIdUsuario->getIdUsuario() !== $v) {
			$this->aFolderRelatedByIdUsuario = null;
		}

	} 
	
	public function setIdFolder($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_folder !== $v) {
			$this->id_folder = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::ID_FOLDER;
		}

		if ($this->aFolderRelatedByIdFolder !== null && $this->aFolderRelatedByIdFolder->getIdFolder() !== $v) {
			$this->aFolderRelatedByIdFolder = null;
		}

	} 
	
	public function setIdObjConcreto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_obj_concreto !== $v) {
			$this->id_obj_concreto = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::ID_OBJ_CONCRETO;
		}

	} 
	
	public function setIdTipoObj($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tipo_obj !== $v) {
			$this->id_tipo_obj = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::ID_TIPO_OBJ;
		}

		if ($this->aTipoObj !== null && $this->aTipoObj->getIdTipoObj() !== $v) {
			$this->aTipoObj = null;
		}

	} 
	
	public function setNombreObj($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre_obj !== $v) {
			$this->nombre_obj = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::NOMBRE_OBJ;
		}

	} 
	
	public function setIsDigital($v)
	{

		if ($this->is_digital !== $v) {
			$this->is_digital = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::IS_DIGITAL;
		}

	} 
	
	public function setDescripcion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descripcion !== $v) {
			$this->descripcion = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::DESCRIPCION;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ObjConcretoPeer::CREATED_AT;
		}

	} 
	
	public function setTexto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->texto !== $v) {
			$this->texto = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::TEXTO;
		}

	} 
	
	public function setTextoTsv($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->texto_tsv !== $v) {
			$this->texto_tsv = $v;
			$this->modifiedColumns[] = ObjConcretoPeer::TEXTO_TSV;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_usuario = $rs->getInt($startcol + 0);

			$this->id_folder = $rs->getInt($startcol + 1);

			$this->id_obj_concreto = $rs->getInt($startcol + 2);

			$this->id_tipo_obj = $rs->getInt($startcol + 3);

			$this->nombre_obj = $rs->getString($startcol + 4);

			$this->is_digital = $rs->getBoolean($startcol + 5);

			$this->descripcion = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->texto = $rs->getString($startcol + 8);

			$this->texto_tsv = $rs->getString($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ObjConcreto object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ObjConcretoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ObjConcretoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ObjConcretoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ObjConcretoPeer::DATABASE_NAME);
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


												
			if ($this->aFolderRelatedByIdUsuario !== null) {
				if ($this->aFolderRelatedByIdUsuario->isModified()) {
					$affectedRows += $this->aFolderRelatedByIdUsuario->save($con);
				}
				$this->setFolderRelatedByIdUsuario($this->aFolderRelatedByIdUsuario);
			}

			if ($this->aFolderRelatedByIdFolder !== null) {
				if ($this->aFolderRelatedByIdFolder->isModified()) {
					$affectedRows += $this->aFolderRelatedByIdFolder->save($con);
				}
				$this->setFolderRelatedByIdFolder($this->aFolderRelatedByIdFolder);
			}

			if ($this->aTipoObj !== null) {
				if ($this->aTipoObj->isModified()) {
					$affectedRows += $this->aTipoObj->save($con);
				}
				$this->setTipoObj($this->aTipoObj);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ObjConcretoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIdObjConcreto($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ObjConcretoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collObjDigitalsRelatedByIdUsuario !== null) {
				foreach($this->collObjDigitalsRelatedByIdUsuario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collObjDigitalsRelatedByIdFolder !== null) {
				foreach($this->collObjDigitalsRelatedByIdFolder as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collObjDigitalsRelatedByIdObjConcreto !== null) {
				foreach($this->collObjDigitalsRelatedByIdObjConcreto as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByIdUsuario !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByIdUsuario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByIdFolder !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByIdFolder as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByIdObjConcreto !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByIdObjConcreto as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByObjIdUsuario !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByObjIdUsuario as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByObjIdFolder !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByObjIdFolder as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto !== null) {
				foreach($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSharedGroups !== null) {
				foreach($this->collSharedGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSharedUsuarios !== null) {
				foreach($this->collSharedUsuarios as $referrerFK) {
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


												
			if ($this->aFolderRelatedByIdUsuario !== null) {
				if (!$this->aFolderRelatedByIdUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFolderRelatedByIdUsuario->getValidationFailures());
				}
			}

			if ($this->aFolderRelatedByIdFolder !== null) {
				if (!$this->aFolderRelatedByIdFolder->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFolderRelatedByIdFolder->getValidationFailures());
				}
			}

			if ($this->aTipoObj !== null) {
				if (!$this->aTipoObj->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoObj->getValidationFailures());
				}
			}


			if (($retval = ObjConcretoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collObjDigitalsRelatedByIdUsuario !== null) {
					foreach($this->collObjDigitalsRelatedByIdUsuario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collObjDigitalsRelatedByIdFolder !== null) {
					foreach($this->collObjDigitalsRelatedByIdFolder as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collObjDigitalsRelatedByIdObjConcreto !== null) {
					foreach($this->collObjDigitalsRelatedByIdObjConcreto as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByIdUsuario !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByIdUsuario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByIdFolder !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByIdFolder as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByIdObjConcreto !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByIdObjConcreto as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByObjIdUsuario !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByObjIdUsuario as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByObjIdFolder !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByObjIdFolder as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto !== null) {
					foreach($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSharedGroups !== null) {
					foreach($this->collSharedGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSharedUsuarios !== null) {
					foreach($this->collSharedUsuarios as $referrerFK) {
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
		$pos = ObjConcretoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIdTipoObj();
				break;
			case 4:
				return $this->getNombreObj();
				break;
			case 5:
				return $this->getIsDigital();
				break;
			case 6:
				return $this->getDescripcion();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getTexto();
				break;
			case 9:
				return $this->getTextoTsv();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ObjConcretoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUsuario(),
			$keys[1] => $this->getIdFolder(),
			$keys[2] => $this->getIdObjConcreto(),
			$keys[3] => $this->getIdTipoObj(),
			$keys[4] => $this->getNombreObj(),
			$keys[5] => $this->getIsDigital(),
			$keys[6] => $this->getDescripcion(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getTexto(),
			$keys[9] => $this->getTextoTsv(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ObjConcretoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIdTipoObj($value);
				break;
			case 4:
				$this->setNombreObj($value);
				break;
			case 5:
				$this->setIsDigital($value);
				break;
			case 6:
				$this->setDescripcion($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setTexto($value);
				break;
			case 9:
				$this->setTextoTsv($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ObjConcretoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUsuario($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdFolder($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdObjConcreto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdTipoObj($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNombreObj($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsDigital($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDescripcion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTexto($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTextoTsv($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ObjConcretoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ObjConcretoPeer::ID_USUARIO)) $criteria->add(ObjConcretoPeer::ID_USUARIO, $this->id_usuario);
		if ($this->isColumnModified(ObjConcretoPeer::ID_FOLDER)) $criteria->add(ObjConcretoPeer::ID_FOLDER, $this->id_folder);
		if ($this->isColumnModified(ObjConcretoPeer::ID_OBJ_CONCRETO)) $criteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);
		if ($this->isColumnModified(ObjConcretoPeer::ID_TIPO_OBJ)) $criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, $this->id_tipo_obj);
		if ($this->isColumnModified(ObjConcretoPeer::NOMBRE_OBJ)) $criteria->add(ObjConcretoPeer::NOMBRE_OBJ, $this->nombre_obj);
		if ($this->isColumnModified(ObjConcretoPeer::IS_DIGITAL)) $criteria->add(ObjConcretoPeer::IS_DIGITAL, $this->is_digital);
		if ($this->isColumnModified(ObjConcretoPeer::DESCRIPCION)) $criteria->add(ObjConcretoPeer::DESCRIPCION, $this->descripcion);
		if ($this->isColumnModified(ObjConcretoPeer::CREATED_AT)) $criteria->add(ObjConcretoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ObjConcretoPeer::TEXTO)) $criteria->add(ObjConcretoPeer::TEXTO, $this->texto);
		if ($this->isColumnModified(ObjConcretoPeer::TEXTO_TSV)) $criteria->add(ObjConcretoPeer::TEXTO_TSV, $this->texto_tsv);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ObjConcretoPeer::DATABASE_NAME);

		$criteria->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $this->id_obj_concreto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdObjConcreto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdObjConcreto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdUsuario($this->id_usuario);

		$copyObj->setIdFolder($this->id_folder);

		$copyObj->setIdTipoObj($this->id_tipo_obj);

		$copyObj->setNombreObj($this->nombre_obj);

		$copyObj->setIsDigital($this->is_digital);

		$copyObj->setDescripcion($this->descripcion);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setTexto($this->texto);

		$copyObj->setTextoTsv($this->texto_tsv);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getObjDigitalsRelatedByIdUsuario() as $relObj) {
				$copyObj->addObjDigitalRelatedByIdUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getObjDigitalsRelatedByIdFolder() as $relObj) {
				$copyObj->addObjDigitalRelatedByIdFolder($relObj->copy($deepCopy));
			}

			foreach($this->getObjDigitalsRelatedByIdObjConcreto() as $relObj) {
				$copyObj->addObjDigitalRelatedByIdObjConcreto($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByIdUsuario() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByIdUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByIdFolder() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByIdFolder($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByIdObjConcreto() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByIdObjConcreto($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByObjIdUsuario() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByObjIdUsuario($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByObjIdFolder() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByObjIdFolder($relObj->copy($deepCopy));
			}

			foreach($this->getRelacionesObjConcretossRelatedByObjIdObjConcreto() as $relObj) {
				$copyObj->addRelacionesObjConcretosRelatedByObjIdObjConcreto($relObj->copy($deepCopy));
			}

			foreach($this->getSharedGroups() as $relObj) {
				$copyObj->addSharedGroup($relObj->copy($deepCopy));
			}

			foreach($this->getSharedUsuarios() as $relObj) {
				$copyObj->addSharedUsuario($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

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
			self::$peer = new ObjConcretoPeer();
		}
		return self::$peer;
	}

	
	public function setFolderRelatedByIdUsuario($v)
	{


		if ($v === null) {
			$this->setIdUsuario(NULL);
		} else {
			$this->setIdUsuario($v->getIdUsuario());
		}


		$this->aFolderRelatedByIdUsuario = $v;
	}


	
	public function getFolderRelatedByIdUsuario($con = null)
	{
		if ($this->aFolderRelatedByIdUsuario === null && ($this->id_usuario !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';

			$this->aFolderRelatedByIdUsuario = FolderPeer::retrieveByPK($this->id_usuario, $con);

			
		}
		return $this->aFolderRelatedByIdUsuario;
	}

	
	public function setFolderRelatedByIdFolder($v)
	{


		if ($v === null) {
			$this->setIdFolder(NULL);
		} else {
			$this->setIdFolder($v->getIdFolder());
		}


		$this->aFolderRelatedByIdFolder = $v;
	}


	
	public function getFolderRelatedByIdFolder($con = null)
	{
		if ($this->aFolderRelatedByIdFolder === null && ($this->id_folder !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseFolderPeer.php';

			$this->aFolderRelatedByIdFolder = FolderPeer::retrieveByPK($this->id_folder, $con);

			
		}
		return $this->aFolderRelatedByIdFolder;
	}

	
	public function setTipoObj($v)
	{


		if ($v === null) {
			$this->setIdTipoObj(NULL);
		} else {
			$this->setIdTipoObj($v->getIdTipoObj());
		}


		$this->aTipoObj = $v;
	}


	
	public function getTipoObj($con = null)
	{
		if ($this->aTipoObj === null && ($this->id_tipo_obj !== null)) {
						include_once 'plugins/memiFolderPlugin/lib/model/om/BaseTipoObjPeer.php';

			$this->aTipoObj = TipoObjPeer::retrieveByPK($this->id_tipo_obj, $con);

			
		}
		return $this->aTipoObj;
	}

	
	public function initObjDigitalsRelatedByIdUsuario()
	{
		if ($this->collObjDigitalsRelatedByIdUsuario === null) {
			$this->collObjDigitalsRelatedByIdUsuario = array();
		}
	}

	
	public function getObjDigitalsRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdUsuario === null) {
			if ($this->isNew()) {
			   $this->collObjDigitalsRelatedByIdUsuario = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->getIdUsuario());

				ObjDigitalPeer::addSelectColumns($criteria);
				$this->collObjDigitalsRelatedByIdUsuario = ObjDigitalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->getIdUsuario());

				ObjDigitalPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjDigitalRelatedByIdUsuarioCriteria) || !$this->lastObjDigitalRelatedByIdUsuarioCriteria->equals($criteria)) {
					$this->collObjDigitalsRelatedByIdUsuario = ObjDigitalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjDigitalRelatedByIdUsuarioCriteria = $criteria;
		return $this->collObjDigitalsRelatedByIdUsuario;
	}

	
	public function countObjDigitalsRelatedByIdUsuario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->getIdUsuario());

		return ObjDigitalPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjDigitalRelatedByIdUsuario(ObjDigital $l)
	{
		$this->collObjDigitalsRelatedByIdUsuario[] = $l;
		$l->setObjConcretoRelatedByIdUsuario($this);
	}


	
	public function getObjDigitalsRelatedByIdUsuarioJoinTipoFile($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdUsuario === null) {
			if ($this->isNew()) {
				$this->collObjDigitalsRelatedByIdUsuario = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collObjDigitalsRelatedByIdUsuario = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastObjDigitalRelatedByIdUsuarioCriteria) || !$this->lastObjDigitalRelatedByIdUsuarioCriteria->equals($criteria)) {
				$this->collObjDigitalsRelatedByIdUsuario = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		}
		$this->lastObjDigitalRelatedByIdUsuarioCriteria = $criteria;

		return $this->collObjDigitalsRelatedByIdUsuario;
	}

	
	public function initObjDigitalsRelatedByIdFolder()
	{
		if ($this->collObjDigitalsRelatedByIdFolder === null) {
			$this->collObjDigitalsRelatedByIdFolder = array();
		}
	}

	
	public function getObjDigitalsRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdFolder === null) {
			if ($this->isNew()) {
			   $this->collObjDigitalsRelatedByIdFolder = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->getIdFolder());

				ObjDigitalPeer::addSelectColumns($criteria);
				$this->collObjDigitalsRelatedByIdFolder = ObjDigitalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->getIdFolder());

				ObjDigitalPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjDigitalRelatedByIdFolderCriteria) || !$this->lastObjDigitalRelatedByIdFolderCriteria->equals($criteria)) {
					$this->collObjDigitalsRelatedByIdFolder = ObjDigitalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjDigitalRelatedByIdFolderCriteria = $criteria;
		return $this->collObjDigitalsRelatedByIdFolder;
	}

	
	public function countObjDigitalsRelatedByIdFolder($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->getIdFolder());

		return ObjDigitalPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjDigitalRelatedByIdFolder(ObjDigital $l)
	{
		$this->collObjDigitalsRelatedByIdFolder[] = $l;
		$l->setObjConcretoRelatedByIdFolder($this);
	}


	
	public function getObjDigitalsRelatedByIdFolderJoinTipoFile($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdFolder === null) {
			if ($this->isNew()) {
				$this->collObjDigitalsRelatedByIdFolder = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->getIdFolder());

				$this->collObjDigitalsRelatedByIdFolder = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_FOLDER, $this->getIdFolder());

			if (!isset($this->lastObjDigitalRelatedByIdFolderCriteria) || !$this->lastObjDigitalRelatedByIdFolderCriteria->equals($criteria)) {
				$this->collObjDigitalsRelatedByIdFolder = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		}
		$this->lastObjDigitalRelatedByIdFolderCriteria = $criteria;

		return $this->collObjDigitalsRelatedByIdFolder;
	}

	
	public function initObjDigitalsRelatedByIdObjConcreto()
	{
		if ($this->collObjDigitalsRelatedByIdObjConcreto === null) {
			$this->collObjDigitalsRelatedByIdObjConcreto = array();
		}
	}

	
	public function getObjDigitalsRelatedByIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdObjConcreto === null) {
			if ($this->isNew()) {
			   $this->collObjDigitalsRelatedByIdObjConcreto = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				ObjDigitalPeer::addSelectColumns($criteria);
				$this->collObjDigitalsRelatedByIdObjConcreto = ObjDigitalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				ObjDigitalPeer::addSelectColumns($criteria);
				if (!isset($this->lastObjDigitalRelatedByIdObjConcretoCriteria) || !$this->lastObjDigitalRelatedByIdObjConcretoCriteria->equals($criteria)) {
					$this->collObjDigitalsRelatedByIdObjConcreto = ObjDigitalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastObjDigitalRelatedByIdObjConcretoCriteria = $criteria;
		return $this->collObjDigitalsRelatedByIdObjConcreto;
	}

	
	public function countObjDigitalsRelatedByIdObjConcreto($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

		return ObjDigitalPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addObjDigitalRelatedByIdObjConcreto(ObjDigital $l)
	{
		$this->collObjDigitalsRelatedByIdObjConcreto[] = $l;
		$l->setObjConcretoRelatedByIdObjConcreto($this);
	}


	
	public function getObjDigitalsRelatedByIdObjConcretoJoinTipoFile($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseObjDigitalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collObjDigitalsRelatedByIdObjConcreto === null) {
			if ($this->isNew()) {
				$this->collObjDigitalsRelatedByIdObjConcreto = array();
			} else {

				$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				$this->collObjDigitalsRelatedByIdObjConcreto = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		} else {
									
			$criteria->add(ObjDigitalPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

			if (!isset($this->lastObjDigitalRelatedByIdObjConcretoCriteria) || !$this->lastObjDigitalRelatedByIdObjConcretoCriteria->equals($criteria)) {
				$this->collObjDigitalsRelatedByIdObjConcreto = ObjDigitalPeer::doSelectJoinTipoFile($criteria, $con);
			}
		}
		$this->lastObjDigitalRelatedByIdObjConcretoCriteria = $criteria;

		return $this->collObjDigitalsRelatedByIdObjConcreto;
	}

	
	public function initRelacionesObjConcretossRelatedByIdUsuario()
	{
		if ($this->collRelacionesObjConcretossRelatedByIdUsuario === null) {
			$this->collRelacionesObjConcretossRelatedByIdUsuario = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdUsuario === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByIdUsuario = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->getIdUsuario());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByIdUsuario = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->getIdUsuario());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByIdUsuario = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByIdUsuario;
	}

	
	public function countRelacionesObjConcretossRelatedByIdUsuario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->getIdUsuario());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByIdUsuario(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByIdUsuario[] = $l;
		$l->setObjConcretoRelatedByIdUsuario($this);
	}


	
	public function getRelacionesObjConcretossRelatedByIdUsuarioJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdUsuario === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByIdUsuario = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->getIdUsuario());

				$this->collRelacionesObjConcretossRelatedByIdUsuario = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByIdUsuario = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdUsuarioCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByIdUsuario;
	}

	
	public function initRelacionesObjConcretossRelatedByIdFolder()
	{
		if ($this->collRelacionesObjConcretossRelatedByIdFolder === null) {
			$this->collRelacionesObjConcretossRelatedByIdFolder = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdFolder === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByIdFolder = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->getIdFolder());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByIdFolder = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->getIdFolder());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByIdFolderCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdFolderCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByIdFolder = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdFolderCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByIdFolder;
	}

	
	public function countRelacionesObjConcretossRelatedByIdFolder($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->getIdFolder());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByIdFolder(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByIdFolder[] = $l;
		$l->setObjConcretoRelatedByIdFolder($this);
	}


	
	public function getRelacionesObjConcretossRelatedByIdFolderJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdFolder === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByIdFolder = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->getIdFolder());

				$this->collRelacionesObjConcretossRelatedByIdFolder = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_FOLDER, $this->getIdFolder());

			if (!isset($this->lastRelacionesObjConcretosRelatedByIdFolderCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdFolderCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByIdFolder = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdFolderCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByIdFolder;
	}

	
	public function initRelacionesObjConcretossRelatedByIdObjConcreto()
	{
		if ($this->collRelacionesObjConcretossRelatedByIdObjConcreto === null) {
			$this->collRelacionesObjConcretossRelatedByIdObjConcreto = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdObjConcreto === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByIdObjConcreto = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByIdObjConcreto = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByIdObjConcreto = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByIdObjConcreto;
	}

	
	public function countRelacionesObjConcretossRelatedByIdObjConcreto($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByIdObjConcreto(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByIdObjConcreto[] = $l;
		$l->setObjConcretoRelatedByIdObjConcreto($this);
	}


	
	public function getRelacionesObjConcretossRelatedByIdObjConcretoJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByIdObjConcreto === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByIdObjConcreto = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				$this->collRelacionesObjConcretossRelatedByIdObjConcreto = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

			if (!isset($this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria) || !$this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByIdObjConcreto = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByIdObjConcretoCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByIdObjConcreto;
	}

	
	public function initRelacionesObjConcretossRelatedByObjIdUsuario()
	{
		if ($this->collRelacionesObjConcretossRelatedByObjIdUsuario === null) {
			$this->collRelacionesObjConcretossRelatedByObjIdUsuario = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByObjIdUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdUsuario === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByObjIdUsuario = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->getIdUsuario());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByObjIdUsuario = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->getIdUsuario());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByObjIdUsuario = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByObjIdUsuario;
	}

	
	public function countRelacionesObjConcretossRelatedByObjIdUsuario($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->getIdUsuario());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByObjIdUsuario(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByObjIdUsuario[] = $l;
		$l->setObjConcretoRelatedByObjIdUsuario($this);
	}


	
	public function getRelacionesObjConcretossRelatedByObjIdUsuarioJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdUsuario === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByObjIdUsuario = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->getIdUsuario());

				$this->collRelacionesObjConcretossRelatedByObjIdUsuario = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_USUARIO, $this->getIdUsuario());

			if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByObjIdUsuario = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdUsuarioCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByObjIdUsuario;
	}

	
	public function initRelacionesObjConcretossRelatedByObjIdFolder()
	{
		if ($this->collRelacionesObjConcretossRelatedByObjIdFolder === null) {
			$this->collRelacionesObjConcretossRelatedByObjIdFolder = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByObjIdFolder($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdFolder === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByObjIdFolder = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->getIdFolder());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByObjIdFolder = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->getIdFolder());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByObjIdFolder = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByObjIdFolder;
	}

	
	public function countRelacionesObjConcretossRelatedByObjIdFolder($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->getIdFolder());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByObjIdFolder(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByObjIdFolder[] = $l;
		$l->setObjConcretoRelatedByObjIdFolder($this);
	}


	
	public function getRelacionesObjConcretossRelatedByObjIdFolderJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdFolder === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByObjIdFolder = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->getIdFolder());

				$this->collRelacionesObjConcretossRelatedByObjIdFolder = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_FOLDER, $this->getIdFolder());

			if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByObjIdFolder = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdFolderCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByObjIdFolder;
	}

	
	public function initRelacionesObjConcretossRelatedByObjIdObjConcreto()
	{
		if ($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto === null) {
			$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = array();
		}
	}

	
	public function getRelacionesObjConcretossRelatedByObjIdObjConcreto($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto === null) {
			if ($this->isNew()) {
			   $this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = RelacionesObjConcretosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				RelacionesObjConcretosPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria->equals($criteria)) {
					$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = RelacionesObjConcretosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria = $criteria;
		return $this->collRelacionesObjConcretossRelatedByObjIdObjConcreto;
	}

	
	public function countRelacionesObjConcretossRelatedByObjIdObjConcreto($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->getIdObjConcreto());

		return RelacionesObjConcretosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRelacionesObjConcretosRelatedByObjIdObjConcreto(RelacionesObjConcretos $l)
	{
		$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto[] = $l;
		$l->setObjConcretoRelatedByObjIdObjConcreto($this);
	}


	
	public function getRelacionesObjConcretossRelatedByObjIdObjConcretoJoinTipoRelacion($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseRelacionesObjConcretosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelacionesObjConcretossRelatedByObjIdObjConcreto === null) {
			if ($this->isNew()) {
				$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = array();
			} else {

				$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		} else {
									
			$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $this->getIdObjConcreto());

			if (!isset($this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria) || !$this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria->equals($criteria)) {
				$this->collRelacionesObjConcretossRelatedByObjIdObjConcreto = RelacionesObjConcretosPeer::doSelectJoinTipoRelacion($criteria, $con);
			}
		}
		$this->lastRelacionesObjConcretosRelatedByObjIdObjConcretoCriteria = $criteria;

		return $this->collRelacionesObjConcretossRelatedByObjIdObjConcreto;
	}

	
	public function initSharedGroups()
	{
		if ($this->collSharedGroups === null) {
			$this->collSharedGroups = array();
		}
	}

	
	public function getSharedGroups($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedGroups === null) {
			if ($this->isNew()) {
			   $this->collSharedGroups = array();
			} else {

				$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				SharedGroupPeer::addSelectColumns($criteria);
				$this->collSharedGroups = SharedGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				SharedGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastSharedGroupCriteria) || !$this->lastSharedGroupCriteria->equals($criteria)) {
					$this->collSharedGroups = SharedGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSharedGroupCriteria = $criteria;
		return $this->collSharedGroups;
	}

	
	public function countSharedGroups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

		return SharedGroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSharedGroup(SharedGroup $l)
	{
		$this->collSharedGroups[] = $l;
		$l->setObjConcreto($this);
	}


	
	public function getSharedGroupsJoinGrupo($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedGroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedGroups === null) {
			if ($this->isNew()) {
				$this->collSharedGroups = array();
			} else {

				$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				$this->collSharedGroups = SharedGroupPeer::doSelectJoinGrupo($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

			if (!isset($this->lastSharedGroupCriteria) || !$this->lastSharedGroupCriteria->equals($criteria)) {
				$this->collSharedGroups = SharedGroupPeer::doSelectJoinGrupo($criteria, $con);
			}
		}
		$this->lastSharedGroupCriteria = $criteria;

		return $this->collSharedGroups;
	}

	
	public function initSharedUsuarios()
	{
		if ($this->collSharedUsuarios === null) {
			$this->collSharedUsuarios = array();
		}
	}

	
	public function getSharedUsuarios($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedUsuarios === null) {
			if ($this->isNew()) {
			   $this->collSharedUsuarios = array();
			} else {

				$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				SharedUsuarioPeer::addSelectColumns($criteria);
				$this->collSharedUsuarios = SharedUsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				SharedUsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastSharedUsuarioCriteria) || !$this->lastSharedUsuarioCriteria->equals($criteria)) {
					$this->collSharedUsuarios = SharedUsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSharedUsuarioCriteria = $criteria;
		return $this->collSharedUsuarios;
	}

	
	public function countSharedUsuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

		return SharedUsuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSharedUsuario(SharedUsuario $l)
	{
		$this->collSharedUsuarios[] = $l;
		$l->setObjConcreto($this);
	}


	
	public function getSharedUsuariosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'plugins/memiFolderPlugin/lib/model/om/BaseSharedUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSharedUsuarios === null) {
			if ($this->isNew()) {
				$this->collSharedUsuarios = array();
			} else {

				$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

				$this->collSharedUsuarios = SharedUsuarioPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $this->getIdObjConcreto());

			if (!isset($this->lastSharedUsuarioCriteria) || !$this->lastSharedUsuarioCriteria->equals($criteria)) {
				$this->collSharedUsuarios = SharedUsuarioPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastSharedUsuarioCriteria = $criteria;

		return $this->collSharedUsuarios;
	}

} 