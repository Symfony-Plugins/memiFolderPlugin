<?php

/**
 * folder actions.
 *
 * @package    portafolio
 * @subpackage folder
 * @author     Andrew
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z Jonathan $
 */
class folderActions extends sfActions
{
  	/**
	* 
	* Acciones que se deben ejecutar antes de que se realice cualquiercosa en ests modulo
	* 
	* */
	
	public function preExecute(){
		if($this->hasRequestParameter('idfoldernav')){
			/*
			* Nos aseguramos de algun posible ataque 
			* de susurpación de id del folder
			* en caso de no trabajar con ssl
			* **/
			$foldernavegar =$this->getRequestParameter('idfoldernav');
			//$this->getUser()->setAttribute('probar', $foldernavegar);
			if($this->esSuFolder($foldernavegar)){
			$this->getUser()->setAttribute('folderactual', $foldernavegar);
			}else{
			//$this->getUser()->setAttribute('folderactual', $this->getUser()->getAttribute('folderhome'));
			//$this->getUser()->setAttribute('probar', 'dice que no es su folder');	
			}
		}
		
	}
	/***
	* 
	*Las acciones que se encuentran en este lugar corresponden a lo que se ejecutará luego de 
	* cualquier accion
	* 
	**/
	public function postExecute(){
		
	}
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	
  	$idnavegadorfolder = $this->getUser()->getAttribute('folderactual');
  	$this->foldersuperior= $this->generaSuperior($this->getUser()->getAttribute('folderactual'));
  	$this->rutaids = $this->generaPath($idnavegadorfolder);
  	$this->folders = $this->generaListaFolder($idnavegadorfolder);
  	$this->archivos = $this->generaListaArchivos($idnavegadorfolder);
  	if($this->getUser()->getAttribute('archivoencache')){
				$this->eliminaArchivoEnCache($this->getUser()->getAttribute('direccionarchivoencache'));
		}
  }
  private function generaPath($idfolderactual){
  	$path = array();
  	$path[] = $idfolderactual;
  	
  	while ($this->tieneSuperior($idfolderactual)) {
  		$valor = $this->generaSuperior($idfolderactual);
  		$path[] = $valor;
  		$idfolderactual = $valor;
  	}
  	return $path;
  }
  private function generaSuperior($idfolderactual){
  	$actual = FolderPeer::retrieveByPK($idfolderactual);
  	$val = $actual->getFolIdFolder();
  	/**
	* recuperamos el folder actual y le pedimos el superior
	* 
	* **/
  	return $val;
  	
  }
  /*
   * Esta funcion nos permite saber si el folder actual 
   * tiene o no un folder padre (superior)
   */
  private function tieneSuperior($idfolder){
  	
  	$criteria = new Criteria();
  	$criteria->add(FolderPeer::ID_FOLDER, $idfolder);
  	$criteria->add(FolderPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	//
  	$criteria->add(FolderPeer::FOL_ID_FOLDER, null);
  	//
  	$resultado = FolderPeer::doSelectOne($criteria);
  	if($resultado){
  		$val = false;
  	}else{
  		$val = true;
  	}
  	return $val;
  }
  private function tieneFolderInferior($idfolder){
  	
  	$criteria = new Criteria();
  	$criteria->add(FolderPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	//si el id del folder actual es igual al superior de algún otro folder
  	//es el superior de algún registro
  	$criteria->add(FolderPeer::FOL_ID_FOLDER, $idfolder);
  	//
  	
  	$resultado = FolderPeer::doSelectOne($criteria);
  	if($resultado){
  		$val = true;
  	}else{
  		$val = false;
  	}
  	return $val;
  }
  
  /*
   * funcion que nos permite saber el nombre del 
   * folder al cual el id hace referencia
   */
  private function generaNombres($arregloids){
  	$nombrepath = array();
  	foreach($arregloids as $idfolder){
  		$folder = FolderPeer::retrieveByPK($idfolder);
  		$nombrepath[] = $folder->getNombreFolder();
  	}
  	return $nombrepath;
  }
  /*
   * funcion que nos permite saber si el folder que nos envian por el post es del usuario autenticado
   */
  private function esSuFolder($idfolderaverificar){
  	//$folderusado = new Folder();
  	$folderusado = FolderPeer::retrieveByPK($idfolderaverificar);
  	$iddeduenio = $folderusado->getIdUsuario();
  	if($this->getUser()->getAttribute('usr_id') == $iddeduenio){
  		$resultado = true;
  	}else{
  		$resultado = false;
  	}
  	return $resultado;
  }
  /*
   * Cuando el usuario quiere crear un directorio venimos a esta acción
   */
  public function executeCreatefolder(){
  	
  	//$this->getUser()->setAttribute('probar',$this->getRequestParameter('namenewfolder'));
  	$nuevofolder= $this->getRequestParameter('namenewfolder');
  	if($nuevofolder){
  	$nombrelimpio = $this->limpiaContenido($nuevofolder,2);
  	$this->creaDirectorio($nombrelimpio);
  	$this->setFlash('form_error','La carpeta fue creada con éxito');
  	}else{
  	$this->setFlash('form_error','La carpeta debe tener un nombre');	
  	}
  	$this->redirect('folder/index');
  }
  /*
   * Aqui es donde creamos el registro en la base de datos
   */
  private function creaDirectorio($nombredenuevodirectorio){
  	
  	$newfolder = new Folder();
  	$newfolder->setIdUsuario($this->getUser()->getAttribute('usr_id'));
  	$newfolder->setFolIdUsuario($this->getUser()->getAttribute('usr_id'));
  	$newfolder->setFolIdFolder($this->getUser()->getAttribute('folderactual'));
  	$newfolder->setNombreFolder($nombredenuevodirectorio);
  	$newfolder->setQuote('0');
  	$newfolder->save();
  	LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  }
 
  /*
   * generamos la lista de folders que se 
   * tienen dentro del folder
   */
  private function generaListaFolder($idfolderactual){
  	$path = array();
  	
  	$criteria = new Criteria();
  	$criteria->add(FolderPeer::ID_USUARIO, $this->getUser()->getAttribute('usr_id'));
  	//
  	$criteria->add(FolderPeer::FOL_ID_FOLDER, $idfolderactual);
  	//
  	$criteria->addAscendingOrderByColumn(FolderPeer::NOMBRE_FOLDER);
  	$resultado = FolderPeer::doSelect($criteria);
  	foreach ($resultado as $folder) {
  		$idresultado = $folder->getIdFolder();
  		$path[] = $idresultado;
  	}
  	
  	return $path;
  }
  /*
   * con esta accion obtenemos la lista de archivos que se encuentran dentro del folder actual 
   */
  private function generaListaArchivos($idfoldernavegando){
  	$archivos = array();
  	$criteria = new Criteria();
  	$criteria->add(ObjConcretoPeer::ID_FOLDER,$idfoldernavegando);
  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ,1);
  	$criteria->add(ObjConcretoPeer::ID_USUARIO,$this->getUser()->getAttribute('usr_id'));
  	$criteria->addAscendingOrderByColumn(ObjConcretoPeer::NOMBRE_OBJ);
  	$resultado = ObjConcretoPeer::doSelect($criteria);
  	$i = 1;
  	if($resultado!=null){
  	foreach ($resultado as $archivo) {
  		$idresultado = $archivo->getIdObjConcreto();
  		$archivos[$i]['nombre'] = $archivo->getNombreObj();
  		$archivos[$i]['id'] = $idresultado;
  		//ahora sacamos el tipo del archivo, es decir la extensión
		$typefile = ObjConcretoPeer::entregaTipoArchivo($idresultado);
		//$this->setFlash('form_error',$typefile); 	
  		if($this->existeThumbnail($typefile)){
  			$archivos[$i]['tipo'] = $typefile;
  		}else{
  			$archivos[$i]['tipo'] = 'otro';
  		}
  		$i++;
  	}
  }
  	
  	return $archivos;  	
  }
  /*
   * Con esta acción modificamos el nombre del folder
   */
  public function executeUpdatefolder(){
  	$idfolderforupdated =$this->getRequestParameter('id_updatefolder');
  	$this->idfolderupdate = $idfolderforupdated;
  	$this->folderinfo=FolderPeer::retrieveByPK($idfolderforupdated);
  	
  }/*
    * Con esta acción realizamos el proceso de eliminar un folder si es que no tiene 
    * un folder interno o un archivo interno
    */
  public function executeDeletefolder(){
  	$idfolderfordelete =$this->getRequestParameter('id_deletefolder');
  	if(!$this->tieneFolderInferior($idfolderfordelete) && !$this->tieneArchivoInferior($idfolderfordelete)){
  		$this->eliminarFolder($idfolderfordelete);
  	}else{
  	 $this->setFlash('form_error', 'El folder Seleccionado No se puede eliminar, posiblemente contenga archivos o carpetas en su interior');	
  	}
  	$this->redirect('folder/index');
  }
  private function eliminarFolder($idfolderdelete){
  	$folderaborrar = FolderPeer::retrieveByPK($idfolderdelete);
  	$folderaborrar->delete();
  	LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  	$this->setFlash('form_error','La carpeta fue eliminada con éxito');
  }
  /**
   * Este metodo nos sirve para saber si una carpeta tiene un archivo dentro 
   */
  private function tieneArchivoInferior($idfolderfordelete){
  	$result = false;
  	$criteria = new Criteria();
  	$criteria->add(ObjConcretoPeer::ID_FOLDER,$idfolderfordelete);
  	$criteria->add(ObjConcretoPeer::ID_TIPO_OBJ,1);
  	$criteria->add(ObjConcretoPeer::ID_USUARIO,$this->getUser()->getAttribute('usr_id'));
  	$resultado = ObjConcretoPeer::doSelect($criteria);
  	if($resultado){
  		$result = true;
  	}
  	return $result;
  }
  /*
   * Vamos a Borrar El archivo que se seleccionó, 
   * obviamente debe borarse el objeto concreto del mismo
   * 
   */
  public function executeDeletearchivo(){
  	$idfilefordelete =$this->getRequestParameter('id_deletefile');
  	$filebin4delete = ObjDigitalPeer::retrieveByPK($this->getUser()->getAttribute('usr_id'),$this->getUser()->getAttribute('folderactual'),$idfilefordelete);
  	$filebin4delete->delete();
  	$criteria = new Criteria();
  	$criteria->add(SharedGroupPeer::ID_OBJ_CONCRETO, $idfilefordelete);
  	SharedGroupPeer::doDelete($criteria);
  	$criteria2 = new Criteria();
  	$criteria2->add(SharedUsuarioPeer::ID_OBJ_CONCRETO, $idfilefordelete);
  	SharedUsuarioPeer::doDelete($criteria2);
  	$criteria3 = new Criteria();
  	$criteria3->add(RelacionesObjConcretosPeer::OBJ_ID_OBJ_CONCRETO, $idfilefordelete);
  	$criteria3->add(RelacionesObjConcretosPeer::ID_TIPORELACION, 2);
  	RelacionesObjConcretosPeer::doDelete($criteria3);
  	ObjConcretoPeer::eliminaComentariosdeArchivo($idfilefordelete);
  	//LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  	$objconcreto4delete = ObjConcretoPeer::retrieveByPK($idfilefordelete);
  	$objconcreto4delete->delete();
  	LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  	$this->setFlash('form_error','El archivo fue eliminado con éxito');
  	$this->redirect('folder/index');
  }
	/*
    * Metodo de ejecuecion de la subida de un archivo, el mismo debe tener 
    */
  public function executeSubirarchivo(){	
  	$fileName = $this->getRequest()->getFileName('file');
  	if($fileName){
  	$archive = array();
  	$this->filebin = 'file';
    $archive['type'] = $this->getRequest()->getFileType('file');
	$archive['tamanio'] = $this->getRequest()->getFileSize('file');
	$archive['extension'] = $this->getRequest()->getFileExtension('file');
	//sacamos la locacióntemporal  del archivo 
	$archive['path']= $this->getRequest()->getFilePath('file');
	if($this->esArchivoTexto($archive['type'])){
		$posdeultimopunto = strrpos($fileName,'.');
		$extension = substr($fileName, $posdeultimopunto+1, 4);
		$namesinextension = str_replace('.'.$extension,'',$fileName);
		$extension = $this->getExtension($archive['type']);
		
	}else{
	$posdeultimopunto = strrpos($fileName,'.');
	$extension = substr($fileName, $posdeultimopunto+1, 4);
	$namesinextension = str_replace('.'.$extension,'',$fileName);
	}
  	$archive['name'] = $this->limpiaContenido($namesinextension, 2);
  	$this->fileuploadname = $archive['name'].'.'.$extension;
  	$this->getRequest()->moveFile('file', sfConfig::get('sf_upload_dir').'/'.$archive['name'].'.'.$extension);
  	$extension = strtolower($extension);
  	$this->tipodearchivo = '.'.$extension;
  	$archive['descripcion'] = '';
  	$this->fileupload = $archive;
	$archivo = new ObjConcreto();
	$archivo->setIdUsuario($this->getUser()->getAttribute('usr_id'));
	//$archivo->setObjIdUsuario($this->getUser()->getAttribute('usr_id'));
  	$archivo->setIdFolder($this->getUser()->getAttribute('folderactual'));
  	//$archivo->setObjIdFolder($this->getUser()->getAttribute('folderactual'));
  	//es de tipo  ya que es un objeto concreto tipo archivo
  	$archivo->setIdTipoObj('1');
  	$archivo->setNombreObj($fileName);
  	if($extension && $fileName && $archive['tamanio']){
  		$archivo->save();
  		LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  		
  	}else{
  		//redireccionar a index
  		$this->redirect('folder/index');
  	}
  	$this->idconcreto = $archivo->getIdObjConcreto(); 
  	}else{
  		$this->redirect('folder/index');
  	}
  }
  public function executeGuardararchivo(){
  	$nombredearchivo = $this->limpiaContenido($this->getRequestParameter('archivoname'),2);
  	$group_ids = $this->getRequestParameter('associated_grupos_shared');
  	$users_ids = $this->getRequestParameter('associated_usuarios_shared');
  	$nombrearchivoenso = $this->getRequestParameter('namefileincarpeta');
  	$iddearchivo = $this->getRequestParameter('archivoupdateid');
  	$localizaciontemporal = $this->getRequestParameter('locationarchivosubido');
  	$descripcionarchivo = $this->getRequestParameter('archivodescripcion');
  	$tamanio = $this->getRequestParameter('filesize');
  	$lugaralmacenamiento = $this->getRequestParameter('lugar_almacenamiento');
  	//llega como .jpg por ejemplo
  	$tipodearchivo = $this->getRequestParameter('tipofile');
  	//hacemos que sea simplemente jpeg
  	$tipo = str_replace('.','',$tipodearchivo);
  	$idtipofile = $this->entregaTipo($tipo);
  	//hacemos el update del objeto concreto archivo
  	if($nombredearchivo && $nombrearchivoenso && $iddearchivo && $descripcionarchivo && $lugaralmacenamiento && $lugaralmacenamiento){
  		$objetoconcreto = ObjConcretoPeer::retrieveByPK($iddearchivo);
  	$objetoconcreto->setNombreObj($nombredearchivo.''.$tipodearchivo);
  	$objetoconcreto->setDescripcion($this->limpiaContenido($descripcionarchivo, 0));
  	$objetoconcreto->setTexto($this->getTextodeArchivo($nombrearchivoenso, $tipo, $nombredearchivo, $tamanio));
  	if($lugaralmacenamiento=='Base de datos'){
  		$objetoconcreto->setIsDigital(true);
  		$flag = true;
  	}
  	else{
  		$objetoconcreto->setIsDigital(false);
  		$flag=false;
  	}
  	$objetoconcreto->save();
  	LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
	/**
	 * lo que haremos en este lugar es actualizar la parte de compartir el documento
	 * 
	 */
  	//$this->getUser()->setAttribute('cosas', $this->getRequest()->getParameterHolder()->getAll()); 	
  	
  	
  	if(is_array($group_ids)){
	  	foreach ($group_ids as $id)
	        {
	          $sharedgroup = new SharedGroup();
	          $sharedgroup->setIdFolder($this->getUser()->getAttribute('folderactual'));
	          $sharedgroup->setIdUsuario($this->getUser()->getAttribute('usr_id'));
	          $sharedgroup->setIdGroup($id);
	          $sharedgroup->setIdObjConcreto($iddearchivo);
	          $sharedgroup->save();
	        }
  	}
  	if(is_array($users_ids)){
	  	foreach ($users_ids as $id2)
	        {
	          $sharedusuario = new SharedUsuario();
	          $sharedusuario->setIdFolder($this->getUser()->getAttribute('folderactual'));
	          $sharedusuario->setIdUsuario($id2);
	          $sharedusuario->setIdObjConcreto($iddearchivo);
	          $sharedusuario->save();
	        }
  	}
  	if($flag){
  		$idop = fopen(sfConfig::get('sf_upload_dir').'/'.$nombrearchivoenso,'r'); 
      	$archivo=fread($idop, $tamanio);
      	fclose($idop);
      	
  		$digital = new ObjDigital();
  		$digital->setIdFolder($this->getUser()->getAttribute('folderactual'));
  		$digital->setIdObjConcreto($iddearchivo);
  		$digital->setIdTipoFile($idtipofile);
  		$digital->setIdUsuario($this->getUser()->getAttribute('usr_id'));
  		$digital->setBinaryData($archivo);
  		$digital ->setTamanio($tamanio);
  		$digital->save();
  		//debido a que el trigger se dispara
  		LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  		//LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  		unlink(sfConfig::get('sf_upload_dir').'/'.$nombrearchivoenso);
  		
  	}else{
  		//verificar que la estructura de directorios esté realizada
  		//guardar archivo en el sistema de ficheros
  		
  		
  	}
    }
  	$this->redirect('folder/index');
  }
  private function entregaTipo($extension){
  	$result ='';
  	$criteria = new Criteria();
  	$criteria->add(TipoFilePeer::NOMBRE_TIPO,$extension);
  	$resultado = TipoFilePeer::doSelectOne($criteria);
  	if(!$resultado){
  		$tipofile = new TipoFile();
  		$tipofile->setNombreTipo($extension);
  		//guardo el tipo de archivo
  		$tipofile->save();
  		LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  		$result = $tipofile->getIdTipoFile();
  	}else{
  		$result = $resultado->getIdTipoFile();
  	}
  	return $result;
  }
	/**
	 * con este método guardamos los nombres de los folders
	 *
	 */
  public function executeGuardarfolder(){
  	$idfolderaguardarse = $this->getRequestParameter('folderupdateid');
  	$foldertosave = FolderPeer::retrieveByPK($idfolderaguardarse);
  	if($foldertosave){
  	$nombrelimpio = $this->limpiaNombre($this->getRequestParameter('foldername'));	
  	$foldertosave->setNombreFolder($nombrelimpio);
  	$foldertosave->save();
  	LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  	$this->redirect('folder/index');
  	}else{
  	$this->redirect('folder/index');	
  	}
  }
  private function existeThumbnail($tipofile){
  	$result = false;
  	$a = array('bin','doc','fla','flv','fla','html','iso','mp3','mpeg','mpg','nfo','otro','ppt','rar','swf','torrent','txt','wma','xls','zip','pdf','jpg','jpeg','png','bmp');
  	foreach ($a as $tipo) {
  		if($tipo == $tipofile){
  			$result=true;
  		}
  	}
  	return $result;
  }
  public function executeDownloadarchivo(){
  	$idarchivodown = $this->getRequestParameter('idarchivodown');
  	$archivo = ObjDigitalPeer::retrieveByPK($this->getUser()->getAttribute('usr_id'),$this->getUser()->getAttribute('folderactual'),$idarchivodown);
  	$this->archivo = $archivo;
  	$id = $archivo->getIdObjConcreto();
  	$tamano = $archivo->getTamanio();
  	$file = ObjConcretoPeer::retrieveByPK($id);
  	$namefile = $file->getNombreObj();
  	$this->name = $namefile;
  	$filecontent = $archivo->getBinaryData()->getContents();
  	$this->contenido = $filecontent;
  	$idop = fopen(sfConfig::get('sf_upload_dir').'/'.$namefile,'w'); 
    $archivo=fwrite($idop, $filecontent);
    fclose($idop);
  	$this->direccion = sfConfig::get('sf_upload_dir').'/'.$namefile;
    //$this->getResponse()->addHttpMeta('content-type', "text/html; charset=utf-8");
  	
  }
  public function executeVolver(){
  	$pathdelete = $this->getRequestParameter('lugar_almacenamiento');
  	$this->eliminaArchivoEnCache($pathdelete);
  }
  private function eliminaArchivoEnCache($direccion){
  	//$this->setFlash('form_error','llegamos aqui');
  	unlink($direccion);
  	$this->getUser()->setAttribute('archivoencache', false);
  	$this->redirect('folder/index');	
  }
  private function getTextodeArchivo($archivo, $tipo, $nombrearchivo, $tamanio){
  	$valor = 'gefolder';
  	$tipodeconversion = $this->tipoPermitido($tipo);
  	$programajava = sfConfig::get('sf_web_dir').'/converter/jodconverter-cli-2.2.1.jar';
  	$nuevoarchivotxt = sfConfig::get('sf_upload_dir').'/'.$nombrearchivo.'.txt';
  	$dirarchivo = sfConfig::get('sf_upload_dir').'/'.$archivo;
  	$nuevoarchivopdf = sfConfig::get('sf_upload_dir').'/'.$nombrearchivo.'.pdf';
  	if( $tipodeconversion == 1){
  		//primero debemos convertir el archivo en pdf y luego convertirlo a txt
  		$permisos = exec("/usr/bin/chmod ugo+rwx $dirarchivo");
  		$salida = exec("java -jar $programajava $dirarchivo $nuevoarchivopdf");
  		$nru = 0;
  		$nro = 0;
  		$nro = substr_count($salida,'ERROR');
  		$nru = substr_count($salida,'error');
  		if($nru == 0 && $nro == 0){
  			$mensaje = exec("pdftotext -layout $nuevoarchivopdf $nuevoarchivotxt");
  			$nru = 0;
  			$nro = 0;
  			$nro = substr_count($mensaje,'ERROR');
  			$nru = substr_count($mensaje,'error');
  			if($nru == 0 && $nro == 0){
  				$idop = fopen($nuevoarchivotxt,'r'); 
      			$archivo=fread($idop, $tamanio);
      			fclose($idop);
      			$limpio = $this->limpiaContenido($archivo, 1);
      			$valor = $limpio;
  				$this->setFlash('form_error','El archivo fue indexado con éxito');
  			}
  		}
  		unlink($nuevoarchivopdf);
  		unlink($nuevoarchivotxt);
  	}else{
  		if($tipodeconversion == 2){
  			$this->setFlash('form_error','LLegamos aqui');
  			$permisos = exec("/usr/bin/chmod ugo+rwx $dirarchivo");
  			$mensaje = exec("/usr/bin/pdftotext -layout $dirarchivo $nuevoarchivotxt");
  			$nru = 0;
  			$nro = 0;
  			$nro = substr_count($mensaje,'ERROR');
  			$nru = substr_count($mensaje,'error');
  			if($nru == 0 && $nro == 0){
  				$idop = fopen($nuevoarchivotxt,'r'); 
      			$archivo=fread($idop, $tamanio);
      			fclose($idop);
      			$limpio = $this->limpiaContenido($archivo, 1);
      			$valor = $limpio;
  				$this->setFlash('form_error','El archivo fue indexado correctamente');
  			}
  			unlink($nuevoarchivotxt);
  		}else{
  			if($tipodeconversion == 3){
  				$idop = fopen($nuevoarchivotxt,'r'); 
      			$archivo=fread($idop, $tamanio);
      			fclose($idop);
      			$limpio = $this->limpiaContenido($archivo, 1);
      			$valor = $limpio;
  				$this->setFlash('form_error','El archivo fue indexado con éxito');
  			}else{
  				//aqui decimos que el archivo no puede ser indexado para búsquedas
  				//dentro del archivo, sinó que será buscado simlemente por comentarios, nombre y descripción.
  				$this->setFlash('form_error','El archivo solo puede ser buscado mediante comentarios, ya que no puede convertirse en un formato TXT o tiene contraseña');
  			}
  		}
  	}
  	
  	return $valor;
  }
  private function tipoPermitido($tipo){
  	$result = 0;
  	$a = array('doc','ppt','xls','odt','odp','ods');
  	foreach ($a as $convertible) {
  		if($convertible == $tipo){
  			$result=1;
  		}
  	}
  	if($tipo == 'pdf'){
  		$result=2;
  	}else{
  		if($tipo == 'txt'){
  			$result=3;
  		}	
  	}
  	return $result;
  }
  private function limpiaContenido($texto, $identificador){
  	$valor = str_replace("",'',$texto);
  	$retorno = str_replace("'",'',$valor);
  	$retorno = str_replace('"','',$retorno);
  	$retorno = str_replace("$",'',$retorno);
  	//vemos si es un archivo para hacerle trim
  	if($identificador == 1){
  		$retorno = trim($retorno);
  	}
  	//quieredecir que es un nombre
  	/*
  	* Limpiaremos el nombre que nos haya proporcionado el usuario 
  	* para que no contenga groserias ni nada parecido
  	* por el momento no hago nada
  	* además que el archivo o folder no debe tener más de 30 caracteres ni una plabra con más de 15 caracteres(por ser de mal gusto)
  	* mantendremos el tipo de archivo pero modificaremos el tamaño de su nombre
  	*/
  	if($identificador == 2){
  		$retorno=str_replace(" ",'_',$retorno);
  		$retorno=str_replace("*",'_',$retorno);
  		$retorno=str_replace(".",'_',$retorno);
  		$retorno=str_replace("/",'_',$retorno);
  		$retorno=str_replace("?",'_',$retorno);
  		$retorno=$this->eliminaAcentos($retorno);
  		$retorno=strtolower($retorno);
  		$retorno=ucfirst($retorno);
  	}
  	return $retorno;
  }
  
  private function esArchivoTexto($tipo){
  	$extension = false;
  	$reconocidos = array('txt'=>'text/plain', 'pdf'=>'application/pdf', 'doc'=>'application/msword', 'xls'=>'application/vnd.ms-excel', 'ppt'=>'application/vnd.ms-powerpoint', 'odt'=>'application/vnd.oasis.opendocument.text', 'ods'=>'application/vnd.oasis.opendocument.spreadsheet', 'odp'=>'application/vnd.oasis.opendocument.presentation');
  	if(in_array($tipo, $reconocidos)){
  		$extension = true;
  	}
  	
  	return $extension;
  }
  private function getExtension($tipo){
  	$reconocidos = array('txt'=>'text/plain', 'pdf'=>'application/pdf', 'doc'=>'application/msword', 'xls'=>'application/vnd.ms-excel', 'ppt'=>'application/vnd.ms-powerpoint', 'odt'=>'application/vnd.oasis.opendocument.text', 'ods'=>'application/vnd.oasis.opendocument.spreadsheet', 'odp'=>'application/vnd.oasis.opendocument.presentation');
  	$extension = array_search($tipo, $reconocidos);  
  	return $extension;
  }
  private function eliminaAcentos($texto){
	static $acentos = "áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙâêîôûÂÊÎÔÛäëïöüÄËÏÖÜ";
	static $validos = "aeiouAEIOUaeiouAEIOUaeiouAEIOUaeiouAEIOU";
	return strtr($texto, $acentos, $validos);
  }
}
