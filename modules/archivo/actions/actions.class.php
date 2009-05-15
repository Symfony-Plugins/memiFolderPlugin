<?php

/**
 * archivo actions.
 *
 * @package    portafolio
 * @subpackage archivo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class archivoActions extends sfActions
{
	public function preExecute(){
		if($this->hasRequestParameter('archivoid')){
			/*
			* Nos aseguramos de algun posible ataque 
			* de usurpación de id del archivo
			* en caso de no trabajar con ssl
			* **/
			$idarchivo =$this->getRequestParameter('archivoid');
			if($this->tienePermiso($idarchivo)){
				$this->getUser()->setAttribute('archivopermitido', true);
				$this->getUser()->setAttribute('archivoactualpermitido', $idarchivo);
				if($this->esSuArchivo($idarchivo)){
					$this->getUser()->setAttribute('archivomodificable', true);
					}else{
						$this->getUser()->setAttribute('archivomodificable', false);
					}
			 }
		}else{
			//no puede ver el archivo ni nada semejante	
			}
		if($this->getUser()->getAttribute('direcciontemporal')){
			$this->eliminaArchivo($this->getUser()->getAttribute('direcciontemporal'));
			$this->getUser()->getAttributeHolder()->remove('direcciontemporal');
		}
		}
	
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
	 if($this->getUser()->getAttribute('archivopermitido')){ 	
	    if($this->getUser()->getAttribute('archivomodificable')){
	    	$this->redirect('archivo/mostrar');
	    }else{
	    	$this->redirect('archivo/comentar');
	    }
	 }else{
	 	$this->forward('error','credencial');
	 }
  }
  public function executeMostrar(){
  	$idarchivo = $this->getUser()->getAttribute('archivoactualpermitido');
  	$archivo = ObjConcretoPeer::retrieveByPK($idarchivo);
  	//ObjConcreto::getNombreObj()
  	$this->archivo = $archivo;
  	$this->comentarios = ObjConcretoPeer::getComentarios($idarchivo);
  	$idarchivodown = $this->getUser()->getAttribute('archivoactualpermitido');
  	$archivodigital = ObjDigitalPeer::retrieveByPK($archivo->getIdUsuario(),$archivo->getIdFolder(),$idarchivodown);
  	$this->tamanio = $archivodigital->getTamanio();
  	$namefile = $archivo->getNombreObj();
  	$filecontent = $archivodigital->getBinaryData()->getContents();
  	$idop = fopen(sfConfig::get('sf_upload_dir').'/'.$namefile,'w'); 
    fwrite($idop, $filecontent);
    fclose($idop);
    $this->getUser()->setAttribute('direcciontemporal', (sfConfig::get('sf_upload_dir').'/'.$namefile));
    $temporales = $this->getUser()->getAttribute('archivos_temp'); 
  	if($this->getRequest()->isSecure()){
    	$this->direccion = 'https://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$temporales[] = 'https://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$this->getUser()->setAttribute('archivos_temp', $temporales);
  	}else{
  		$this->direccion = 'http://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
  		$temporales[] = 'http://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$this->getUser()->setAttribute('archivos_temp', $temporales);
  	}
  }
  public function executeComentar(){
  	$idarchivo = $this->getUser()->getAttribute('archivoactualpermitido');
  	$archivo = ObjConcretoPeer::retrieveByPK($idarchivo);
  	//ObjConcreto::getNombreObj()
  	$this->archivo = $archivo;
  	$this->comentarios = ObjConcretoPeer::getComentarios($idarchivo);
  	$idarchivodown = $this->getUser()->getAttribute('archivoactualpermitido');
  	$archivodigital = ObjDigitalPeer::retrieveByPK($archivo->getIdUsuario(),$archivo->getIdFolder(),$idarchivodown);
  	$this->tamanio = $archivodigital->getTamanio();
  	$namefile = $archivo->getNombreObj();
  	$filecontent = $archivodigital->getBinaryData()->getContents();
  	$idop = fopen(sfConfig::get('sf_upload_dir').'/'.$namefile,'w'); 
    fwrite($idop, $filecontent);
    fclose($idop);
    $this->getUser()->setAttribute('direcciontemporal', (sfConfig::get('sf_upload_dir').'/'.$namefile));
    $temporales = $this->getUser()->getAttribute('archivos_temp'); 
  	if($this->getRequest()->isSecure()){
    	$this->direccion = 'https://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$temporales[] = 'https://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$this->getUser()->setAttribute('archivos_temp', $temporales);
  	}else{
  		$this->direccion = 'http://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
  		$temporales[] = 'http://'.$this->getRequest()->getHost().'/foldertemporal/'.$namefile;
    	$this->getUser()->setAttribute('archivos_temp', $temporales);
  	}
  }
  public function executeEditar(){
  	if($this->getUser()->getAttribute('archivomodificable')){
  		$idarchivo = $this->getUser()->getAttribute('archivoactualpermitido');
  		$file = ObjConcretoPeer::retrieveByPK($idarchivo);
  		$archivo = array();
  		$archivo['id'] = $idarchivo;
  		$archivo['nombrecabecera'] = $file->getNombreObj();
  		$archivo['nombre'] = $this->limpiarExtension($file->getNombreObj());
  		$archivo['descripcion'] = $file->getDescripcion();
  		$archivo['tipo'] = ObjConcretoPeer::entregaTipoArchivo($idarchivo);
  		$archivo['tamanio'] = ObjConcretoPeer::entregaTamanioArchivo($idarchivo);
  		$this->datos = $archivo;
  		$this->archivo = $file;   		
  	}
  	
  }
  public function executeUpdate(){
  	if($this->getRequestParameter('archivoname') && $this->getRequestParameter('archivodescripcion')){
  		$group_ids = $this->getRequestParameter('associated_grupos_shared');
  		$users_ids = $this->getRequestParameter('associated_usuarios_shared');
  		$nombre = $this->limpiaTexto($this->getRequestParameter('archivoname'));
  		$descripcion = $this->limpiaTexto($this->getRequestParameter('archivodescripcion'));
  		$idarchivo = $this->getRequestParameter('archivoupdateid');
  		$extension = '.'.$this->getRequestParameter('archivoupdatetipo');
  		$tamanio = $this->getRequestParameter('archivoupdatetamanio');
  		$archivo = ObjConcretoPeer::retrieveByPK($idarchivo);
  		$idfolder = $archivo->getIdFolder();
  		$texto = $nombre.' '.$descripcion.' '.$archivo->getTexto().' '.$tamanio;
  		$archivo->setNombreObj($nombre.''.$extension);
  		$archivo->setDescripcion($descripcion);
  		$archivo->setTextoTsv(ObjConcretoPeer::generaTsv($texto));
  		$archivo->save();
  		LogUpdate::doBitacora($this->getUser()->getAttribute('usr_id'), $this->getUser()->getAttribute('usr_ip'));
  		
  		$criteria = new Criteria();
  		$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $idarchivo);
  		SharedGroupPeer::doDelete($criteria);
  		$criteria2 = new Criteria();
  		$criteria2->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $idarchivo);
  		SharedUsuarioPeer::doDelete($criteria2);
  		
  		
	  	if(is_array($group_ids)){
		  	foreach ($group_ids as $id)
		        {
		          $sharedgroup = new SharedGroup();
		          $sharedgroup->setIdFolder($idfolder);
		          $sharedgroup->setIdUsuario($this->getUser()->getAttribute('usr_id'));
		          $sharedgroup->setIdGroup($id);
		          $sharedgroup->setIdObjConcreto($idarchivo);
		          $sharedgroup->save();
		        }
	  	}
	  	if(is_array($users_ids)){
		  	foreach ($users_ids as $id2)
		        {
		          $sharedusuario = new SharedUsuario();
		          $sharedusuario->setIdFolder($idfolder);
		          $sharedusuario->setIdUsuario($id2);
		          $sharedusuario->setIdObjConcreto($idarchivo);
		          $sharedusuario->save();
		        }
	  	}
	  	
	  	$this->redirect('folder/index');
	  	
  	}else{
  		return sfView::NONE;
  	}
  }
  public function executeGuardarcomentario(){
  	$idarchivo =$this->getRequestParameter('idarchivo');
  	$comentario = $this->limpiaTexto($this->getRequestParameter('archivocomentario'));
  	if($comentario){
  		if(!$this->existeComentario($comentario)){
  			$comentariobd = new ObjConcreto();
  			$comentariobd->setIdFolder($this->getUser()->getAttribute('folderhome'));
  			$comentariobd->setIdTipoObj(2);
  			$comentariobd->setIdUsuario($this->getUser()->getAttribute('usr_id'));
  			$comentariobd->setNombreObj($comentario);
  			$comentariobd->setTexto($comentario);
  			$comentariobd->setTextoTsv(ObjConcretoPeer::generaTsv($comentario));
  			$comentariobd->save();
  			LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  			$idcomentario = $comentariobd->getIdObjConcreto();
  			$archivo = ObjConcretoPeer::retrieveByPK($idarchivo);
  			$comentarioarchivo = new RelacionesObjConcretos();   			
  			$comentarioarchivo->setIdFolder($comentariobd->getIdFolder());
  			$comentarioarchivo->setIdObjConcreto($comentariobd->getIdObjConcreto());
  			$comentarioarchivo->setIdTiporelacion(1);
  			$comentarioarchivo->setIdUsuario($comentariobd->getIdUsuario());
  			$comentarioarchivo->setObjIdFolder($archivo->getIdFolder());
  			$comentarioarchivo->setObjIdObjConcreto($archivo->getIdObjConcreto());
  			$comentarioarchivo->setObjIdUsuario($archivo->getIdUsuario());
  			$comentarioarchivo->save(); 
  		}  		
  	}else{
  		
  	}
  	$this->redirect("archivo/index?archivoid=$idarchivo");
  }
  public function executeDeletecoment(){
  	$idarchivo = $this->getUser()->getAttribute('archivoactualpermitido');
  	$idcomentario =$this->getRequestParameter('idcoment');
  	if($idcomentario && $this->puedeEliminarComentario($idcomentario)){
	  	$criteria = new Criteria();
	  	$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idcomentario);
	  	$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
	  	$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
	  	RelacionesObjConcretosPeer::doDelete($criteria);
	  	$criteria3 = new Criteria();
	  	$criteria3->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idcomentario);
	  	RelacionesObjConcretosPeer::doDelete($criteria3);
	  	$criteria2 = new Criteria();
	  	$criteria2->add(ObjConcretoPeer::ID_OBJ_CONCRETO, $idcomentario);
	  	ObjConcretoPeer::doDelete($criteria2);
	  	LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));	
  	}
  	$this->redirect("archivo/index?archivoid=$idarchivo");
  }
  public function executeUltimosComentarios(){
  	$idsarchivo = ObjConcretoPeer::getIdsArchivosUsuario();
  	$idsdeloscompartidos = ObjConcretoPeer::getIdsCompartidos();
  	foreach ($idsdeloscompartidos as $idarchivo){
  		$idsarchivo[] = $idarchivo;
  	}
  	$idsarchivo=array_unique($idsarchivo);
  	$this->comentarios = ObjConcretoPeer::entregaUltimosComentarios($idsarchivo);
  }
  private function tienePermiso($idarchivo){
  	$resultado = false;
  	//sus archivos
  	$idsobjdeusuario = ObjConcretoPeer::getIdsArchivosUsuario();
  	//los archivos que le compartieron
  	$idsdeloscompartidos = ObjConcretoPeer::getIdsCompartidos();
  	if(in_array($idarchivo, $idsdeloscompartidos) || in_array($idarchivo, $idsobjdeusuario)){
  			$resultado = true;
  	}
  	return $resultado;
  }
  private function esSuArchivo($idarchivo){
  	$resultado = false;
  	$idsobjdeusuario = array();
  	//sus archivos
  	$idsobjdeusuario = ObjConcretoPeer::getIdsArchivosUsuario();
  	if(in_array($idarchivo, $idsobjdeusuario)){
  			$resultado = true;
  	}
  	return $resultado;
  }
  private function eliminaArchivo($ruta){
  	unlink($ruta);
  }
  private function limpiaTexto($texto){
  	$resultado='';
  	$texto = str_replace('  ',' ',$texto);
  	$texto = str_replace('"','',$texto);
  	$texto = str_replace("'",'',$texto);
  	$texto = str_replace('*','',$texto);
  	$texto = str_replace('/','',$texto);
  	$texto = str_replace('?','',$texto);
  	$texto = str_replace('$','',$texto);
	$resultado = $texto;
	return $resultado;		
  }
  private function existeComentario($texto){
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
  private function puedeEliminarComentario($idcomentario){
  	$result = false;
  	$idarchivo = $this->getUser()->getAttribute('archivoactualpermitido');
  	$criteria = new Criteria();
  	$criteria->add(RelacionesObjConcretosPeer::ID_OBJ_CONCRETO, $idcomentario);
  	$criteria->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idarchivo);
  	$criteria->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 1);
  	$resultado = RelacionesObjConcretosPeer::doSelectOne($criteria);
  	if($resultado){
  		$result = true;
  	}
  	return $result;
  }
  private function limpiarExtension($fileName){
  	$posdeultimopunto = strrpos($fileName,'.');
	$extension = substr($fileName, $posdeultimopunto+1, 4);
	$namesinextension = str_replace('.'.$extension,'',$fileName);
  	return $namesinextension;
  }
}
