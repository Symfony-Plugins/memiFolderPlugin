<?php

/**
 * seguridad actions.
 *
 * @package    portafolio
 * @subpackage seguridad
 * @author     andrew
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z andrew $
 */
class seguridadActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeLogin()
  {
		  if ($this->getRequest()->getMethod() != sfRequest::POST)
	  {
	    // display the form
	    $this->getRequest()->setAttribute('referer', $this->getRequest()->getReferer());
	    return sfView::SUCCESS;
	    
	  }
	  else
	  {
	    // handle the form submission
	    
	    $nickname = $this->getRequestParameter('nickname');
	    $c = new Criteria();
	    $c->add(UsuarioPeer::LOGIN, $nickname);
	    $user = UsuarioPeer::doSelectOne($c);
	 
	    // nickname existe?
	    if ($user)
	    {
	      // password es OK?
	      $password1 = $this->getRequestParameter('password');
	      $passwd = md5($password1);
	      $nickname = $this->getRequestParameter('nickname');
	      $d = new Criteria();
	  	  $d->add(UsuarioPeer::LOGIN, $nickname);
	  	  $d->add(UsuarioPeer::PASSWORD, $passwd);
	  	  $d->add(UsuarioPeer::IS_ACTIVE, true);
	   	  $result = UsuarioPeer::doSelectOne($d);
	 	//login y password correcto?
	      if ($result)
	      {
	        //lo autentico
	        $this->getUser()->setAuthenticated(true);
	        $usrip=$this->getIp();
	        $secondusrip=$this->getIpreal();
	        $temprol= $result->getIdRol();
	        //coloco atributos al usuario
	        
	        //variables>>>>>>>>>>>>>
	        $userid = $result->getIdUsuario();
	        $usernombrecompleto = $result->getNombre().' '.$result->getApellidos();
	        
	        
	        $this->getUser()->setAttribute('nombrecompleto', $usernombrecompleto);
	        $this->getUser()->setAttribute('usr_id', $userid);
	        $this->getUser()->setAttribute('usr_login', $nickname);
	        $this->getUser()->setAttribute('usr_name', $result->getNombre());
	        $this->getUser()->setAttribute('usr_apellidos', $result->getApellidos());
	        $this->getUser()->setAttribute('usr_ip', $secondusrip);
	        $this->getUser()->setAttribute('usr_idrol', $temprol);
	      	//le coloco credenciales depende de sus grupos
	      	$c = new Criteria();
	      	$c->add(PermisoUserPeer::ID_ROL, $temprol);
	      	$permiusr = PermisoUserPeer::doSelect($c);
	      	$m = new Criteria();
	      	$m->add(PermisoGrupoPeer::ID_ROL, $temprol);
	      	$permigr = PermisoGrupoPeer::doSelect($m);
	      	$formularios = array();
	      	$formulario = array();
	      	//primero añadimos las credenciales que optiene como usuario
	      	foreach($permiusr as $permusr){
	      		$valo=$permusr->getIdForm();
	      		$cd = new Criteria();
	      		$cd->add(FormularioPeer::ID_FORM, $valo);
	      		$permil = FormularioPeer::doSelectOne($cd);
	      		$tmp = $permil->getPagina();
	      		$this->getUser()->addCredential($tmp);
	      		//$formularios[$tmp]=$tmp;
	      		$formularios[]=$tmp;	
	      	}
	      	//luego añadimos las credenciales que optiene como miembro de un grupo
	      	$i=0;
	      	foreach($permigr as $permgr){
	      		$val=$permgr->getIdForm();
	      		$cd = new Criteria();
	      		$cd->add(FormularioPeer::ID_FORM, $val);
	      		$permis = FormularioPeer::doSelectOne($cd);
	      		$temp = $permis->getPagina();
	      		$this->getUser()->addCredential($temp);
	      		//$formularios[$temp]=$temp;
	      		$formulario[]=$temp;
	      		$i++;
	      	}
	      	//rescatamos el id del folder /home del usuario
	      	$criteria = new Criteria();
	      	$criteria->add(FolderPeer::ID_USUARIO, $userid);
	      	$criteria->add(FolderPeer::FOL_ID_USUARIO,$userid);
	      	$criteria->add(FolderPeer::FOL_ID_FOLDER, null);
	      	$existente = FolderPeer::doSelectOne($criteria);
	      	/*
	      	 * 
	      	 * luego de saber el id del folder /home
	      	 *  
	      	 */
	      	$archivostemporales = array();
	      	$this->getUser()->addCredential('folder');
	      	$this->getUser()->addCredential('busqueda');
	      	$this->getUser()->addCredential('archivo');
	      	$idfolderhome = $existente->getIdFolder();
	      	$this->getUser()->setAttribute('folderhome', $idfolderhome);
	      	$this->getUser()->setAttribute('folderactual', $idfolderhome);
	      	$this->getUser()->setAttribute('usr_nro_grupos', $i);
	      	$this->getUser()->setAttribute('formususr', $formularios);	      		               
	        $this->getUser()->setAttribute('formusgrp', $formulario);
	        $this->getUser()->setAttribute('archivos_temp', $archivostemporales);
	      	//colocando datos en el registro de session de usuario
	        $idsession = session_id();
	        $criterion = new Criteria();
	        $criterion->add(SessionTempPeer::SESSION_ID, $idsession);
	      	$sessiontemp = SessionTempPeer::doSelectOne($criterion);
	      	$sessiontemp->setIdUsuario($userid);
	      	$sessiontemp->setNombreUsuario($usernombrecompleto);
	      	$sessiontemp->setIpUser($secondusrip);
	      	$sessiontemp->save();
	      	
	      	
	        
	        //$this->getUser()->setAttribute('nickname', $user->getNickname(), 'subscriber');
	 		
	        // redirect to last page
	        //$this->getUser()->setAuthenticated(true);
	        return $this->redirect($this->getRequestParameter('referer', '@homepage'));
	      }
	    }
  	 }
  }
  
  public function executePrueba(){
  	$this->redirect('@homepage');  
  }
  public function executeLogout(){
  		$direccionestemporales = $this->getUser()->getAttribute('archivos_temp');
  		if($direccionestemporales){
  			foreach ($direccionestemporales as $direccion){
  				unlink($direccion);
  			}
  		}
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->clearCredentials();
		$this->getUser()->getAttributeHolder()->remove('usr_login');
		$this->getUser()->shutdown();
		$idsession = session_id();
	    $criterion = new Criteria();
	    $criterion->add(SessionTempPeer::SESSION_ID, $idsession);
	    $sessiontemp = SessionTempPeer::doSelectOne($criterion);
	    $sessiontemp->delete();
		$this->redirect('@homepage');  
	}
  public function getIpreal(){
  	//esta función me permite conocer la ip real del usuario
	if ($_SERVER) {
		if ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) {
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif ( $_SERVER["HTTP_CLIENT_IP"] ) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
	} else {
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$realip = getenv( 'HTTP_CLIENT_IP' );
		} else {
			$realip = getenv( 'REMOTE_ADDR' );
		}
	}
	return $realip;
  }
  public function getIp(){
  	//segundo scrip que busca el ip del usuario de una manera más precisa
	  	if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
	   	{
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "alta_anomicidad" );
	   
	      // los proxys van añadiendo al final de esta cabecera
	      // las direcciones ip que van "ocultando". Para localizar la ip real
	      // del usuario se comienza a mirar por el principio hasta encontrar
	      // una dirección ip que no sea del rango privado. En caso de no
	      // encontrarse ninguna se toma como valor el REMOTE_ADDR
	   
	      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
	   
	      reset($entries);
	      while (list(, $entry) = each($entries))
	      {
	         $entry = trim($entry);
	         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
	         {
	            // http://www.faqs.org/rfcs/rfc1918.html
	            $private_ip = array(
	                  '/^0\./',
	                  '/^127\.0\.0\.1/',
	                  '/^192\.168\..*/',
	                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
	                  '/^10\..*/');
	   
	            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
	   
	            if ($client_ip != $found_ip)
	            {
	               $client_ip = $found_ip;
	               break;
	            }
	         }
	      }
	   }
	   else
	   {
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "alta_anomicidad" );
	   }
	   
	   return $client_ip;
  }
}