<?php

/**
 * Subclass for performing query and update operations on the 'obj_concreto' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ObjConcretoPeer extends BaseObjConcretoPeer
{
	/**
	 * funcion que nos permite sacar todos los ids de los objetos concretos que son de los grupos a los que 
	 * pertenece al usuario y tambien los objetosconcretos que estan compartidos al usuario.
	 *
	 * @return array de ids de los obj concretos que estan asociados al usuario ya sea a nivel de grupo o por
	 * compartir al usuario.
	 */
	public static function getIdsCompartidos(){
		$idsobjcompartidos = array();
		$idusuario = sfContext::getInstance()->getUser()->getAttribute('usr_id');
		$idsgrupos = UsuarioPeer::getIdsGrupos();
		$criteria = new Criteria();
		$criteria->add(SharedUsuarioPeer::ID_USUARIO, $idusuario);
		$compartidosausuario = SharedUsuarioPeer::doSelect($criteria);
		if($compartidosausuario){
			foreach ($compartidosausuario as $usrshared){
				$idsobjcompartidos[] = $usrshared->getIdObjConcreto();
			}
		}
		$criteria2 = new Criteria();
		$criteria2->add(SharedGroupPeer::ID_GROUP, $idsgrupos, Criteria::IN);
		$casugrupo = SharedGroupPeer::doSelect($criteria2);
		if($casugrupo){
			foreach ($casugrupo as $grpshared){
				$idsobjcompartidos[] = $grpshared->getIdObjConcreto();
			}
		}
		sfContext::getInstance()->getUser()->setAttribute('error', $idsobjcompartidos);
		return $idsobjcompartidos;
	}
	public static function generaTsv($texto){
		if($texto){
			$texto = ObjConcretoPeer::limpiaContenido($texto);
			$conexion = Propel::getConnection();
			$consulta = "SELECT to_tsvector('spanish', '$texto') AS tsv";
			$sentencia = $conexion->prepareStatement($consulta);
		  	$resultset2 = $sentencia->executeQuery();
		  	$resultset2->next();
		  	$valor = $resultset2->getString('tsv');
		  	$resultset2->close();
		  	return $valor;
		}
	}
	public static function resaltaContenido($idobjconcreto){
		$valor = '';
		$obj = ObjConcretoPeer::retrieveByPK($idobjconcreto);
		$contenido = $obj->getTexto();
		$contenido = ObjConcretoPeer::limpiaContenido($contenido);
		$texto = trim(sfContext::getInstance()->getUser()->getAttribute('search'));
		if($obj && $texto){
			$conexion = Propel::getConnection();
			$consulta = "SELECT ts_headline('spanish', '$contenido', plainto_tsquery('spanish','$texto'), 'StartSel = <b>, StopSel = </b>, MinWords = 18, MaxWords = 25') AS resaltado";
			$sentencia = $conexion->prepareStatement($consulta);
		  	$resultset2 = $sentencia->executeQuery();
		  	$resultset2->next();
		  	$valor = $resultset2->getString('resaltado');
		  	$resultset2->close();	  	
		}
		return $valor;
	}
	public static function limpiaContenido($texto){
		$valor = str_replace("",'',$texto);
	  	$retorno = str_replace("'",'',$valor);
	  	$retorno = str_replace('"','',$retorno);
	  	$retorno = str_replace("$",'',$retorno);
	  	$retorno = str_replace("?",'',$retorno);
  		return $retorno;
	}
	public static function getIdsArchivosUsuario(){
		$idsobjdeusuario = array();
		$criteria = new Criteria();
		$criteria->add(ObjConcretoPeer::ID_USUARIO, sfContext::getInstance()->getUser()->getAttribute('usr_id'));
	  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, 1);
	  	$resultado = ObjConcretoPeer::doSelect($criteria);
	  	if($resultado){
	  		foreach ($resultado as $objusr){
	  		$idsobjdeusuario[] = $objusr->getIdObjConcreto(); 
	  		}
	  	}
	  	return $idsobjdeusuario;
	}
	public static function getComentarios($idarchivo){
		$resultado = false;
		$criteria = new Criteria();
		//primero sacamos los ids de los comentarios relacionados con el archivo
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
		$comentariosrelacionados = RelacionesObjConcretosPeer::doSelect($criteria);
		if($comentariosrelacionados){
			$ids = array();
			foreach ($comentariosrelacionados as $comentariorel){
				$ids[] = $comentariorel->getIdObjConcreto();
			}
			//ahora con esos ids sacamos los obj concretos, es decir los comentarios en si mismo
			$criteria2 = new Criteria();
			$criteria2->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $ids, Criteria::IN);
			$resultado = ObjConcretoPeer::doSelect($criteria2);
		}
		return $resultado;
	}
	
	public static function getNroComentarios($idarchivo){
		$resultado = false;
		$criteria = new Criteria();
		//primero sacamos los ids de los comentarios relacionados con el archivo
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
		$comentariosrelacionados = RelacionesObjConcretosPeer::doSelect($criteria);
		if($comentariosrelacionados){
			$ids = array();
			foreach ($comentariosrelacionados as $comentariorel){
				$ids[] = $comentariorel->getIdObjConcreto();
			}
			//ahora con esos ids sacamos los obj concretos, es decir los comentarios en si mismo
			$criteria2 = new Criteria();
			$criteria2->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $ids, Criteria::IN);
			$resultado = ObjConcretoPeer::doCount($criteria2);
		}
		return $resultado;
	}
	
	public static function getIdsComentariosPermitidos($idsarchivos){
		if($idsarchivos){
			$ids = array();
			foreach ($idsarchivos as $idarchivo){
				$idscomentarios = ObjConcretoPeer::getIdsComentariosArchivo($idarchivo);
				if($idscomentarios){
					foreach ($idscomentarios as $idcomentario){
						$ids[] = $idcomentario;
					}
				}
			}
		}else{
			$ids = false;
		}
		return $ids;
	}
	public static function getIdsComentariosArchivo($idarchivo){
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$comentariosrelacionados = RelacionesObjConcretosPeer::doSelect($criteria);
		if($comentariosrelacionados){
			$resultado = array();
			foreach ($comentariosrelacionados as $comentariorelacionado){
				$resultado[] = $comentariorelacionado->getIdObjConcreto();
			}
		}else{
			$resultado = false;
		}
		return $resultado;	
	}
	public static function getIdArchivoDeComentario($idcomentario){
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idcomentario);
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$archivorelacionado = RelacionesObjConcretosPeer::doSelectOne($criteria);
		if($archivorelacionado){
			$id = $archivorelacionado->getObjIdObjConcreto();
		}else{
			$id = false;
		}
		return $id;
	}
	public static function eliminaComentariosdeArchivo($idarchivo){
		$idscomentarios = ObjConcretoPeer::getIdsComentariosArchivo($idarchivo);
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO,$idarchivo);
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION,1);
		RelacionesObjConcretosPeer::doDelete($criteria);
		if($idscomentarios){
			foreach ($idscomentarios as $idcomentario){
				//eliminamos las búsquedas que estén relacionadas con el comentario
				$criteria3 = new Criteria();
				$criteria3->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO,$idcomentario);
				$criteria3->add(RelacionesObjConcretosPeer::ID_TIPORELACION,3);
				RelacionesObjConcretosPeer::doDelete($criteria3);
				
				//eliminamos los comentarios
				$criteria2 = new Criteria();
				$criteria2->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $idcomentario);
				ObjConcretoPeer::doDelete($criteria2);
				LogDelete::doBitacora(sfContext::getInstance()->getUser()->getAttribute('nombrecompleto'), sfContext::getInstance()->getUser()->getAttribute('usr_ip'));
			}
		}
	}
	public static function entregaTipoArchivo($idarchivo){
		$valor = false;
		if($idarchivo){
			$conexion = Propel::getConnection();
			$consulta = "SELECT id_tipo_file AS tipo FROM obj_digital WHERE id_obj_concreto = $idarchivo";
			$sentencia = $conexion->prepareStatement($consulta);
		  	$resultset = $sentencia->executeQuery();
		  	$resultset->next();
		  	$idtipo = $resultset->getInt('tipo');
		  	$resultset->close();
		  	$valor = TipoFilePeer::traeNombre($idtipo);
		}
		return $valor;
	}
	public static function entregaUltimosComentarios($idsarchivos){
		if($idsarchivos){
			$post = array();
			$m = 0;
			foreach ($idsarchivos as $idarchivo){
				if($m < 15){	
					$comentarios = ObjConcretoPeer::getComentariosdeArchivo($idarchivo);
					if($comentarios){
						foreach ($comentarios as $comentario){
							if($m < 15){
							$post[] = $comentario;
							$m++;
							}
						}
					}
				}
			}
		}else{
			$post = false;
		}
		
		return $post;
	}
	public static function getComentariosdeArchivo($idarchivo){
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$comentariosrelacionados = RelacionesObjConcretosPeer::doSelect($criteria);
		if($comentariosrelacionados){
			$resultado = array();
			foreach ($comentariosrelacionados as $comentariorelacionado){
				$resultado[] = ObjConcretoPeer::retrieveByPK($comentariorelacionado->getIdObjConcreto());
			}
		}else{
			$resultado = false;
		}
		return $resultado;	
	}
	public static function getNombreArchivoDeComentario($idcomentario){
		$criteria = new Criteria();
		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idcomentario);
		$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
		$archivorelacionado = RelacionesObjConcretosPeer::doSelectOne($criteria);
		if($archivorelacionado){
			$archivo = ObjConcretoPeer::retrieveByPK($archivorelacionado->getObjIdObjConcreto());
			$nombre = $archivo->getNombreObj();
		}else{
			$nombre = false;
		}
		return $nombre;
	}
	public static function entregaTamanioArchivo($idarchivo){
		$valor = 0;
		if($idarchivo){
			$conexion = Propel::getConnection();
			$consulta = "SELECT tamanio AS tamanio FROM obj_digital WHERE id_obj_concreto = $idarchivo";
			$sentencia = $conexion->prepareStatement($consulta);
		  	$resultset = $sentencia->executeQuery();
		  	$resultset->next();
		  	$idtipo = $resultset->getInt('tamanio');
		  	$resultset->close();
		  	if($idtipo){
		  		$valor = $idtipo; 
		  	}
		}
		return $valor;
	}
}
