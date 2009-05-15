<?php

/**
 * Subclass for performing query and update operations on the 'usuario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UsuarioPeer extends BaseUsuarioPeer
{
	public static function getGruposPresentes(){
		$idusr = sfContext::getInstance()->getUser()->getAttribute('usr_id');
		$idsgrupos = array();
		$idsgrupos[0]='';
		$criteria = new Criteria();
		$criteria->add(UserGroupPeer::ID_USUARIO, $idusr);
		$usrgrupos = UserGroupPeer::doSelect($criteria);
		foreach ($usrgrupos as $grupoid){
			$grupo = GrupoPeer::retrieveByPK($grupoid->getIdGroup()); 
			if($grupo){$idsgrupos[] = $grupo->getNombre();}
			   
		}
		return $idsgrupos;
	}
	public static function getUsuariosPresentes(){
		$idusr = sfContext::getInstance()->getUser()->getAttribute('usr_id');
				$idsgrupos = array();
				$idsusuarios = array();
				$nombredeusuarios = array();
				$nombredeusuarios[0] = '';
				$criteria = new Criteria();
		    	$criteria->add(UserGroupPeer::ID_USUARIO, $idusr);
		    	$usrgrupos = UserGroupPeer::doSelect($criteria);
		    	foreach ($usrgrupos as $grupo){
		    		   $idsgrupos[] = $grupo->getIdGroup();
		    	}
		    	$criteria2 = new Criteria();
		    	$criteria2->add(UserGroupPeer::ID_GROUP, $idsgrupos, Criteria::IN);
		    	$usrgrupos2 = UserGroupPeer::doSelect($criteria2);
				foreach ($usrgrupos2 as $usuario){
		    		   $idsusuarios[] = $usuario->getIdUsuario();
		    	}
		    	$array2 = $idsusuarios;
		    	for ($i=0;$i<count($idsusuarios);$i++){
		    		if($idsusuarios[$i]==$idusr){
		    			$idsusuarios[$i]=0;
		    		}
		    	}
                $c= new Criteria();
                $c->add(UsuarioPeer::ID_USUARIO, $idsusuarios, Criteria::IN);
                $usuarios = UsuarioPeer::doSelect($c);
                foreach($usuarios as $user){ 
                	$nombredeusuarios[] = $user->getNombre().''.$user->getApellidos();	
                }  
                return $nombredeusuarios;
	}
	public static function getNombreDeUsuario($id){
		$usuario = UsuarioPeer::retrieveByPK($id);
		return $usuario->getNombre().' '.$usuario->getApellidos();
	}
	public static function getIdsGrupos(){
		$idusr = sfContext::getInstance()->getUser()->getAttribute('usr_id');
		$idsgrupos = array();
		$criteria = new Criteria();
		$criteria->add(UserGroupPeer::ID_USUARIO, $idusr);
		$usrgrupos = UserGroupPeer::doSelect($criteria);
		foreach ($usrgrupos as $grupoid){
			$grupo = GrupoPeer::retrieveByPK($grupoid->getIdGroup()); 
			if($grupo){
				if(!in_array($grupoid->getIdGroup(), $idsgrupos)){
					$idsgrupos[] = $grupoid->getIdGroup();
				}
			}
			   
		}
		return $idsgrupos;
	}
}
