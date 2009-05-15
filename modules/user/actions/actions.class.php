<?php

/**
 * user actions.
 *
 * @package    portafolio
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class userActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('user', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/usuario/filters');

    // pager
    $this->pager = new sfPropelPager('Usuario', 20);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/usuario')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/usuario');
    }
  }

  public function executeCreate()
  {
    return $this->forward('user', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('user', 'edit');
  }

  public function executeEdit()
  {
    $this->usuario = $this->getUsuarioOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateUsuarioFromRequest();

      $this->saveUsuario($this->usuario);

      $this->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('user/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('user/list');
      }
      else
      {
        return $this->redirect('user/edit?id_usuario='.$this->usuario->getIdUsuario());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('id_usuario'));
    $this->forward404Unless($this->usuario);

    try
    {
      $this->deleteUsuario($this->usuario);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Usuario. Make sure it does not have any associated items.');
      return $this->forward('user', 'list');
    }

    return $this->redirect('user/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->usuario = $this->getUsuarioOrCreate();
    $this->updateUsuarioFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveUsuario($usuario)
  {
  	//veremos si el usuario ya tiene un password en md5 y si no lo colocamos
  	$temp=$usuario->getPassword();
  	if( strlen($temp)<30){//levenshtein($usuario->getPasswrod())<25){ 
  	$pss = md5($temp);
  	$usuario->setPassword($pss);//md5());
  	}
    $usuario->save();
    LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    
	$iduser = $usuario->getIdUsuario();
      // Update many-to-many for "grupos"
      $c = new Criteria();
      $c->add(UserGroupPeer::ID_USUARIO, $usuario->getPrimaryKey());
      UserGroupPeer::doDelete($c);

      $ids = $this->getRequestParameter('associated_grupos');
      if (is_array($ids))
      {
        foreach ($ids as $id)
        {
          $UserGroup = new UserGroup();
          $UserGroup->setIdUsuario($usuario->getPrimaryKey());
          $UserGroup->setIdGroup($id);
          $UserGroup->save();
        }
      }
    //creamos la consulta para ver si existe la capeta /home
    $consulta = new Criteria();
  	$consulta->add(FolderPeer::ID_USUARIO, $iduser);
  	$consulta->add(FolderPeer::FOL_ID_USUARIO, $iduser);
  	$consulta->add(FolderPeer::FOL_ID_FOLDER, null);
  	$resultado = FolderPeer::doSelectOne($consulta);
  	
  	/**
  	 * vemos si existe el folder home
  	 * si no existe creamos el folder /home del nuevo usuario 
  	 */
  	if(!$resultado){
  		
  		$folderhome = new Folder();
  		$folderhome->setIdUsuario($iduser);
  		$folderhome->setFolIdUsuario($iduser);
  		$folderhome->setNombreFolder($usuario->getNombre().' '.$usuario->getApellidos());
  		$folderhome->setQuote(10);
   		$folderhome->save();
   		LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  		
  	}

  }

  protected function deleteUsuario($usuario)
  {
  	//eliminar toda la información del usuario, es decir, todos sus archivos y carpetas
  	//mejor si llamamos a una función del modelo
    $usuario->delete();
    LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    
  }

  protected function updateUsuarioFromRequest()
  {
    $usuario = $this->getRequestParameter('usuario');

    if (isset($usuario['login']))
    {
      $this->usuario->setLogin($usuario['login']);
    }
    if (isset($usuario['password']))
    {
      $this->usuario->setPassword($usuario['password']);
    }
    if (isset($usuario['nombre']))
    {
      $this->usuario->setNombre($usuario['nombre']);
    }
    if (isset($usuario['apellidos']))
    {
      $this->usuario->setApellidos($usuario['apellidos']);
    }
    $this->usuario->setIsActive(isset($usuario['is_active']) ? $usuario['is_active'] : 0);
    if (isset($usuario['created_at']))
    {
      if ($usuario['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($usuario['created_at']))
          {
            $value = $dateFormat->format($usuario['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $usuario['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->usuario->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->usuario->setCreatedAt(null);
      }
    }
    if (isset($usuario['remenber_key']))
    {
      $this->usuario->setRemenberKey($usuario['remenber_key']);
    }
    if (isset($usuario['id_rol']))
    {
    $this->usuario->setIdRol($usuario['id_rol'] ? $usuario['id_rol'] : null);
    }
    if (isset($usuario['grupos']))
    {
      $this->usuario->setGrupos($usuario['grupos']);
    }
  }

  protected function getUsuarioOrCreate($id_usuario = 'id_usuario')
  {
    if (!$this->getRequestParameter($id_usuario))
    {
      $usuario = new Usuario();
    }
    else
    {
      $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter($id_usuario));

      $this->forward404Unless($usuario);
    }

    return $usuario;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/usuario');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/usuario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/usuario/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/usuario/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/usuario/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/usuario/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_rol_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::ID_ROL, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::ID_ROL, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_rol']) && $this->filters['id_rol'] !== '')
    {
      $c->add(UsuarioPeer::ID_ROL, $this->filters['id_rol']);
    }
    if (isset($this->filters['login_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::LOGIN, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::LOGIN, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['login']) && $this->filters['login'] !== '')
    {
      $c->add(UsuarioPeer::LOGIN, strtr($this->filters['login'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['nombre_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::NOMBRE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nombre']) && $this->filters['nombre'] !== '')
    {
      $c->add(UsuarioPeer::NOMBRE, strtr($this->filters['nombre'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['is_active_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::IS_ACTIVE, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::IS_ACTIVE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['is_active']) && $this->filters['is_active'] !== '')
    {
      $c->add(UsuarioPeer::IS_ACTIVE, $this->filters['is_active']);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/usuario/sort'))
    {
      $sort_column = UsuarioPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/usuario/sort') == 'asc')
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
      'usuario{login}' => 'Login:',
      'usuario{password}' => 'Password:',
      'usuario{nombre}' => 'Nombre del usuario:',
      'usuario{apellidos}' => 'Apellidos del usuario:',
      'usuario{is_active}' => 'Está activo:',
      'usuario{created_at}' => 'Fecha de creación:',
      'usuario{remenber_key}' => 'Clave para adivinar password:',
      'usuario{id_rol}' => 'rol:',
      'usuario{grupos}' => 'Grupos:',
    );
  }
}
