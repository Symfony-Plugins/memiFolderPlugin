<?php

/**
 * busqueda actions.
 *
 * @package    portafolio
 * @subpackage busqueda
 * @author     Andrew
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z Andrew $
 */
class busquedaActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	if($this->getRequest()->getParameter('avanzado')){
  		$this->grupos = UsuarioPeer::getGruposPresentes();
  		$this->usuarios = UsuarioPeer::getUsuariosPresentes();
  		$this->getUser()->setAttribute('search','');  		
  	}
  	$this->busquedas = $this->muestraBusquedas();
  }
  /*
   * metodo con el cual se realiza la búsqueda en si debemos crear el criterio y 
   * realizar el filtrado de los obj concretos, además de guardar la búsqueda como un obj_concreto en si mismo
   */
  public function executeList(){
  	if($this->getRequest()->getParameter('palabras') || $this->getUser()->getAttribute('search')){
  	if($this->getRequest()->getParameter('palabras')){
  		$texto = trim($this->getRequest()->getParameter('palabras'));
  		$this->getUser()->setAttribute('search', $this->getRequest()->getParameter('palabras'));
  	}else{
  		$texto = trim($this->getUser()->getAttribute('search'));
  	}	
  	$texto = str_replace('  ',' ',$texto);
  	$texto = str_replace("'",'',$texto);
  	$texto = str_replace('*','',$texto);
  	$texto = str_replace('/','',$texto);
  	$grupos = array();
  	$grupos = UsuarioPeer::getGruposPresentes();
  	$usuarios = array();
  	$usuarios = UsuarioPeer::getUsuariosPresentes();
  	
  	if($this->getRequest()->getParameter('campo2')){
  		
  		$coment = 'hola el valor es:'. $this->getRequest()->getParameter('campo2');
  	}
  	if($this->getRequest()->getParameter('campo3')){
  		$coment = $coment.'____'.'hola el valor es:'. $this->getRequest()->getParameter('campo3');
  	}
  	if($this->getRequest()->getParameter('campo4')){
  		$coment = $coment.'____'.'hola el valor es:'. $this->getRequest()->getParameter('campo4');
  		$this->setFlash('form_error',$coment);
  	}
  	if($this->getRequest()->getParameter('grupo')){
  		$coment = $coment.'____'.'hola el valor es:'. $this->getRequest()->getParameter('grupo');
  		$this->setFlash('form_error',$coment);
  	}
  	if($this->getRequest()->getParameter('usuario')){
  		$coment = $coment.'____'.'hola el valor es:'. $this->getRequest()->getParameter('usuario');
  		$this->setFlash('form_error',$coment);
  	}
  	/**
  	 * lo que vamos a hacer es algo osado pero tengo buena espina acerca del modo en que se puede realizar el
  	 * trabajo de recuperar datos:
  	 * primero haremos la consulta a nivel de creole y recuperamos los ids de los objetos concretos que cumplen con el criteri
  	 * todo esto mediante tsquery y tsvector
  	 */
  	//primero creamos la consulta tsquery
  	//en busqueda1 se encuentran las metapalabras o lexemas que será comparados con
  	//el interior de los documentos
  	//$this->setFlash('form_error',$busqueda1);
	$idsobjconcretos = array();
  	$conexion = Propel::getConnection();
  	$consulta = "SELECT id_obj_concreto FROM obj_concreto WHERE texto_tsv @@ plainto_tsquery('spanish','$texto')";
  	$sentencia = $conexion->prepareStatement($consulta);
  	$resultset2 = $sentencia->executeQuery();
  	$nro = $resultset2->getRecordCount();
  	$resultset2->next();
  	for($i=0;$i<$nro;$i++){
  	$idsobjconcretos[] = $resultset2->getInt('id_obj_concreto');
  	$resultset2->next();
  	}
  	$resultset2->close();
  	$idspermitidos = $this->getArchivosPermitidos($idsobjconcretos);
  	if($idspermitidos){
  		$this->generaRelaciones($idspermitidos, $texto);
  	}
  	$this->pager = new sfPropelPager('ObjConcreto', 6);
  	$idtipos = array('1','2');
    $c = new Criteria();
    $c->add(ObjConcretoPeer::ID_OBJ_CONCRETO,$idspermitidos,Criteria::IN);
    $c->add(ObjConcretoPeer::ID_TIPO_OBJ, $idtipos, Criteria::IN);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/obj_concreto')));
    $this->pager->init();
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/obj_concreto');
    }
  	}else{
  		return $this->redirect('busqueda', 'index');
  	}
  }
  /**
   * *filtramos los archivos que pueden ser visibles para el usuario
   *
   * @param array de los ids que cumplen con el criterio de búsqueda $idscumplen
   * @return array de ids que puede ver el usuario
   */
  private function getArchivosPermitidos($idscumplen){
  	//los archivos que son propios del usuario
  	$idsobjdeusuario = ObjConcretoPeer::getIdsArchivosUsuario();
  	//los archivos que son de los compañeros que compartieron su contenido con el usuario
  	$idsdeloscompartidos = ObjConcretoPeer::getIdsCompartidos();
  	$comentariosdearchivosdeusuario = ObjConcretoPeer::getIdsComentariosPermitidos($idsobjdeusuario);
  	$comentariosdearchivoscompartidos = ObjConcretoPeer::getIdsComentariosPermitidos($idsdeloscompartidos);
  	$idspermitidos = array();  	
  	foreach ($idscumplen as $id){
  		//se debe hacer control para ver si los array realmente existen
  		if(in_array($id, $idsdeloscompartidos) || in_array($id, $idsobjdeusuario) || in_array($id, $comentariosdearchivosdeusuario) || in_array($id, $comentariosdearchivoscompartidos)){
  			$idspermitidos[] = $id;
  		}
  	}
  	//ids de los comentarios de los archivos permitidos
  	return $idspermitidos;
  }
  /**
   * Este es el método mediante el cual se crea un objeto concreto de tipo búsqueda
   * y se crean las relaciones entre la búsqueda y los archivos relacionados
   *
   * @param ids de los obj concretos que cumplen con el criterio de búsqueda $ids
   * @param texto mediante el cual se realiza la búsqueda $texto
   */
  private function generaRelaciones($ids, $texto){
  		$textolimpio = $this->limpiaTexto($texto);
		if($ids && $textolimpio ){			
			if(!$this->existeBusqueda($textolimpio)){
				$busqueda = new ObjConcreto();
				$busqueda->setIdFolder($this->getUser()->getAttribute('folderhome'));
				$busqueda->setIdTipoObj(3);
				$busqueda->setIdUsuario($this->getUser()->getAttribute('usr_id'));
				$busqueda->setNombreObj($textolimpio);
				$busqueda->setTexto($textolimpio);
				$busqueda->setTextoTsv(ObjConcretoPeer::generaTsv($textolimpio));
				$busqueda->save();
				LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
				$idbusqueda = $busqueda->getIdObjConcreto();
			}else{
				$idbusqueda = $this->traeIddeBusqueda($textolimpio);
				$busqueda = ObjConcretoPeer::retrieveByPK($idbusqueda);
			}
			$criteria3 = new Criteria();
			$criteria3->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idbusqueda);
			RelacionesObjConcretosPeer::doDelete($criteria3);
			foreach($ids as $id){
				$obj = ObjConcretoPeer::retrieveByPK($id);				
				$relacion = new RelacionesObjConcretos();
				$relacion->setIdFolder($busqueda->getIdFolder());
				$relacion->setIdObjConcreto($busqueda->getIdObjConcreto());
				$relacion->setIdUsuario($busqueda->getIdUsuario());
				$relacion->setObjIdFolder($obj->getIdFolder());
				$relacion->setObjIdObjConcreto($obj->getIdObjConcreto());
				$relacion->setObjIdUsuario($obj->getIdUsuario());    
				if($obj->getIdTipoObj()==1){
					//si es un archivo
					$relacion->setIdTiporelacion(2);
				}else{
					if($obj->getIdTipoObj()==2){
						//si es un comentario
						$relacion->setIdTiporelacion(3);
					}else{
						if($obj->getIdTipoObj()==3){
							//si es una búsqueda
							$relacion->setIdTiporelacion(4);
						}//aqui se pueden añadir algunos otros tipos de obj concretos más
					}
				}//termina la comporbación del tipo de objeto que es
				$relacion->save();
			}//termina el ciclo de los ids
			
		}  	
  }
  private function limpiaTexto($texto){
  	$resultado='';
  	$texto = str_replace('  ',' ',$texto);
  	$texto = str_replace("'",'',$texto);
  	$texto = str_replace('*','',$texto);
  	$texto = str_replace('/','',$texto);
	$resultado = $texto;
	return $resultado;		
  }
  private function existeBusqueda($texto){
  	$result = false;
  	$criteria = new Criteria();
  	$criteria->add(ObjConcretoPeer::TEXTO, $texto);
  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ,3);
  	$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	$objs = ObjConcretoPeer::doSelectOne($criteria);
  	if($objs){
  		$result = true;
  	}
  	return $result;
  }
	private function traeIddeBusqueda($texto){
  	$criteria = new Criteria();
  	$criteria->add(ObjConcretoPeer::TEXTO, $texto);
  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ,3);
  	$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	$obj = ObjConcretoPeer::doSelectOne($criteria);
  		$result = $obj->getIdObjConcreto();
  	return $result;
  }
  private function muestraBusquedas(){
  	$busquedas = array();
  	$i = 0;
  	$criteria = new Criteria();
  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ, 3);
  	$criteria->add(ObjConcretoPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	$criteria->addDescendingOrderByColumn(ObjConcretoPeer::CREATED_AT);
  	$criteria->setLimit(10);
  	$resultados = ObjConcretoPeer::doSelect($criteria);
  	if($resultados){
  		foreach ($resultados as $resultado){
  			if($this->numeroRelacionados($resultado->getIdObjConcreto()) > 0){
  			$busquedas [$i]['contenido'] = $resultado->getNombreObj();
  			$busquedas [$i]['fecha'] = $resultado->getCreatedAt();
  			$busquedas [$i]['nroresultados'] = $this->numeroRelacionados($resultado->getIdObjConcreto());
  			$i++;
  			}else{
  				$criteria2 = new Criteria();
				$criteria2->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $resultado->getIdObjConcreto());
				ObjConcretoPeer::doDelete($criteria2);
				LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  			}		
  		}
  	}
  	return $busquedas;
  }
	private function numeroRelacionados($idbusqueda){
  		$resultado = 0;
  		$criteria = new Criteria();
  		$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idbusqueda);
		$nro = RelacionesObjConcretosPeer::doCount($criteria);
		if($nro > 0 ){
			$resultado = $nro;
		}else{
		}
		return $resultado;
  	}
}
