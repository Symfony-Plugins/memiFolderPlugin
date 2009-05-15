<?php

/**
 * rol actions.
 *
 * @package    portafolio
 * @subpackage rol
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class rolActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('rol', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();


    // pager
    $this->pager = new sfPropelPager('Rol', 10);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/rol')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/rol');
    }
  }

  public function executeCreate()
  {
    return $this->forward('rol', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('rol', 'edit');
  }

  public function executeEdit()
  {
    $this->rol = $this->getRolOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateRolFromRequest();

      $this->saveRol($this->rol);

      $this->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('rol/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('rol/list');
      }
      else
      {
        return $this->redirect('rol/edit?id_rol='.$this->rol->getIdRol());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->rol = RolPeer::retrieveByPk($this->getRequestParameter('id_rol'));
    $this->forward404Unless($this->rol);

    try
    {
      $this->deleteRol($this->rol);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Rol. Make sure it does not have any associated items.');
      return $this->forward('rol', 'list');
    }

    return $this->redirect('rol/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->rol = $this->getRolOrCreate();
    $this->updateRolFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveRol($rol)
  {
    $rol->save();
	LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    
      // Update many-to-many for "permiso_usuario"
      $c = new Criteria();
      $c->add(PermisoUserPeer::ID_ROL, $rol->getPrimaryKey());
      PermisoUserPeer::doDelete($c);

      $ids = $this->getRequestParameter('associated_permiso_usuario');
      if (is_array($ids))
      {
        foreach ($ids as $id)
        {
          $PermisoUser = new PermisoUser();
          $PermisoUser->setIdRol($rol->getPrimaryKey());
          $PermisoUser->setIdForm($id);
          $PermisoUser->save();
        }
      }

      // Update many-to-many for "permiso_grupo1"
      $c = new Criteria();
      $c->add(PermisoGrupoPeer::ID_ROL, $rol->getPrimaryKey());
      PermisoGrupoPeer::doDelete($c);

      $ids = $this->getRequestParameter('associated_permiso_grupo1');
      if (is_array($ids))
      {
      	for($ic=2;$ic<3;$ic++){
      		//lo que hacemos es darle permisos de lectura y escritura pero no puede eliminar registros 
      		//aunque podemos colocar un behavior el parhanoid para ser exactos y con eso controlamos que los registros no se eliminen de la base de datos. 
      		$ids2 = $ids;
        	foreach ($ids as $id)
        	{
          		$PermisoGrupo = new PermisoGrupo();
          		$PermisoGrupo->setIdRol($rol->getPrimaryKey());
          		$PermisoGrupo->setIdForm($id);
          		$PermisoGrupo->setIdPermiso($ic);
          		$PermisoGrupo->save();
        	}
      	}
      }

  }

  protected function deleteRol($rol)
  {
    $rol->delete();
    LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  }

  protected function updateRolFromRequest()
  {
    $rol = $this->getRequestParameter('rol');

    if (isset($rol['nombre']))
    {
      $this->rol->setNombre($rol['nombre']);
    }
    if (isset($rol['permiso_usuario']))
    {
      $this->rol->setPermisoUsuario($rol['permiso_usuario']);
    }
    if (isset($rol['permiso_grupo1']))
    {
      $this->rol->setPermisoGrupo1($rol['permiso_grupo1']);
    }
  }

  protected function getRolOrCreate($id_rol = 'id_rol')
  {
    if (!$this->getRequestParameter($id_rol))
    {
      $rol = new Rol();
    }
    else
    {
      $rol = RolPeer::retrieveByPk($this->getRequestParameter($id_rol));

      $this->forward404Unless($rol);
    }

    return $rol;
  }

  protected function processFilters()
  {
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/rol/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/rol/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/rol/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/rol/sort'))
    {
      $sort_column = RolPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/rol/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'rol{nombre}' => 'Nombre del Rol:',
      'rol{permiso_usuario}' => 'Credenciales de Usuario:',
      'rol{permiso_grupo1}' => 'Credenciales de Grupo:',
    );
  }
  private function hola(){
  	//aqui no hay nada
  }
}
