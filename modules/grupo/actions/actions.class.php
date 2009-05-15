<?php

/**
 * grupo actions.
 *
 * @package    portafolio
 * @subpackage grupo
 * @author     Andrew Claros Santander
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z @ndrew $
 */
class grupoActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('grupo', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/grupo/filters');

    // pager
    $this->pager = new sfPropelPager('Grupo', 10);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/grupo')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/grupo');
    }
  }

  public function executeCreate()
  {
    return $this->forward('grupo', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('grupo', 'edit');
  }

  public function executeEdit()
  {
    $this->grupo = $this->getGrupoOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateGrupoFromRequest();

      $this->saveGrupo($this->grupo);

      $this->setFlash('notice', 'Las modificaciones se guardaron con éxito');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('grupo/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('grupo/list');
      }
      else
      {
        return $this->redirect('grupo/edit?id_group='.$this->grupo->getIdGroup());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('id_group'));
    $this->forward404Unless($this->grupo);

    try
    {
      $this->deleteGrupo($this->grupo);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No se puede eliminar el registro seleccionado, asegurese que no está asociado a algun otro registro.');
      return $this->forward('grupo', 'list');
    }

    return $this->redirect('grupo/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->grupo = $this->getGrupoOrCreate();
    $this->updateGrupoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveGrupo($grupo)
  {
    $grupo->save();
    LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    

  }

  protected function deleteGrupo($grupo)
  {
    $grupo->delete();
    LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  }

  protected function updateGrupoFromRequest()
  {
    $grupo = $this->getRequestParameter('grupo');

    if (isset($grupo['nombre']))
    {
      $this->grupo->setNombre($grupo['nombre']);
    }
    if (isset($grupo['descripcion']))
    {
      $this->grupo->setDescripcion($grupo['descripcion']);
    }
    if (isset($grupo['id_rol']))
    {
    $this->grupo->setIdRol($grupo['id_rol'] ? $grupo['id_rol'] : null);
    }
  }

  protected function getGrupoOrCreate($id_group = 'id_group')
  {
    if (!$this->getRequestParameter($id_group))
    {
      $grupo = new Grupo();
    }
    else
    {
      $grupo = GrupoPeer::retrieveByPk($this->getRequestParameter($id_group));

      $this->forward404Unless($grupo);
    }

    return $grupo;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/grupo');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/grupo/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/grupo/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/grupo/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/grupo/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/grupo/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['nombre_is_empty']))
    {
      $criterion = $c->getNewCriterion(GrupoPeer::NOMBRE, '');
      $criterion->addOr($c->getNewCriterion(GrupoPeer::NOMBRE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nombre']) && $this->filters['nombre'] !== '')
    {
      $c->add(GrupoPeer::NOMBRE, strtr($this->filters['nombre'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/grupo/sort'))
    {
      $sort_column = GrupoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/grupo/sort') == 'asc')
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
      'grupo{nombre}' => 'Nombre del Grupo:',
      'grupo{descripcion}' => 'Descripcion del Grupo:',
      'grupo{id_rol}' => 'Rol:',
    );
  }
}
