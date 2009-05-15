<?php

/**
 * permiso actions.
 *
 * @package    portafolio
 * @subpackage permiso
 * @author     Jonathan Andrei Claros Santander
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z @ndrew $
 */
class permisoActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('permiso', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/permiso/filters');

    // pager
    $this->pager = new sfPropelPager('Permiso', 7);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/permiso')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/permiso');
    }
  }

  public function executeCreate()
  {
    return $this->forward('permiso', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('permiso', 'edit');
  }

  public function executeEdit()
  {
    $this->permiso = $this->getPermisoOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatePermisoFromRequest();

      $this->savePermiso($this->permiso);

      $this->setFlash('notice', 'Sus modificaciones se guardaron con éxito');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('permiso/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('permiso/list');
      }
      else
      {
        return $this->redirect('permiso/edit?id_permiso='.$this->permiso->getIdPermiso());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->permiso = PermisoPeer::retrieveByPk($this->getRequestParameter('id_permiso'));
    $this->forward404Unless($this->permiso);

    try
    {
      $this->deletePermiso($this->permiso);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No se puede eliminar el regsitro seleccionado asegurese que no tiene otros registros asociados.');
      return $this->forward('permiso', 'list');
    }

    return $this->redirect('permiso/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->permiso = $this->getPermisoOrCreate();
    $this->updatePermisoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function savePermiso($permiso)
  {
    $permiso->save();
	LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    
  }

  protected function deletePermiso($permiso)
  {
    $permiso->delete();
    LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  }

  protected function updatePermisoFromRequest()
  {
    $permiso = $this->getRequestParameter('permiso');

    if (isset($permiso['nombre_permiso']))
    {
      $this->permiso->setNombrePermiso($permiso['nombre_permiso']);
    }
    if (isset($permiso['descripcionper']))
    {
      $this->permiso->setDescripcionper($permiso['descripcionper']);
    }
  }

  protected function getPermisoOrCreate($id_permiso = 'id_permiso')
  {
    if (!$this->getRequestParameter($id_permiso))
    {
      $permiso = new Permiso();
    }
    else
    {
      $permiso = PermisoPeer::retrieveByPk($this->getRequestParameter($id_permiso));

      $this->forward404Unless($permiso);
    }

    return $permiso;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/permiso');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/permiso/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/permiso/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/permiso/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/permiso/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/permiso/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['nombre_permiso_is_empty']))
    {
      $criterion = $c->getNewCriterion(PermisoPeer::NOMBRE_PERMISO, '');
      $criterion->addOr($c->getNewCriterion(PermisoPeer::NOMBRE_PERMISO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nombre_permiso']) && $this->filters['nombre_permiso'] !== '')
    {
      $c->add(PermisoPeer::NOMBRE_PERMISO, strtr($this->filters['nombre_permiso'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/permiso/sort'))
    {
      $sort_column = PermisoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/permiso/sort') == 'asc')
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
      'permiso{nombre_permiso}' => 'Nombre de Permiso:',
      'permiso{descripcionper}' => 'Descripcion del Permiso:',
    );
  }
}
