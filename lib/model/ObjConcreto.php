<?php

/**
 * Subclass for representing a row from the 'obj_concreto' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ObjConcreto extends BaseObjConcreto
{
	public function compartiraGrupo(){
				$idusr = sfContext::getInstance()->getUser()->getAttribute('usr_id');
				$idsgrupos = array();
				$criteria = new Criteria();
		    	$criteria->add(UserGroupPeer::ID_USUARIO, $idusr);
		    	$usrgrupos = UserGroupPeer::doSelect($criteria);
		    	foreach ($usrgrupos as $grupo){
		    		   $idsgrupos[] = $grupo->getIdGroup();
		    	}
                $c= new Criteria();
                $c->add(GrupoPeer::ID_GROUP, $idsgrupos, Criteria::IN);//$idsgrupos, Criteria::IN);
                return $c;
	}
	public function compartiraUsuario(){
				$idusr = sfContext::getInstance()->getUser()->getAttribute('usr_id');
				$idsgrupos = array();
				$idsusuarios = array();
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
                return $c;
	} 
}
