<?php

/**
 * formu actions.
 *
 * @package    portafolio
 * @subpackage formu
 * @author     andrew
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z andrew $
 */
class formuActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('formu', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/formulario/filters');

    // pager
    $this->pager = new sfPropelPager('Formulario', 10);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/formulario')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/formulario');
    }
  }

  public function executeCreate()
  {
    return $this->forward('formu', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('formu', 'edit');
  }

  public function executeEdit()
  {
    $this->formulario = $this->getFormularioOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateFormularioFromRequest();

      $this->saveFormulario($this->formulario);

      $this->setFlash('notice', 'Sus modificaciones fueron guardadas con éxito');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('formu/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('formu/list');
      }
      else
      {
        return $this->redirect('formu/edit?id_form='.$this->formulario->getIdForm());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->formulario = FormularioPeer::retrieveByPk($this->getRequestParameter('id_form'));
    $this->forward404Unless($this->formulario);

    try
    {
      $this->deleteFormulario($this->formulario);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No se pudo eliminar el registro seleccionado, vea si el registro tiene asociado algún otro registro.');
      return $this->forward('formu', 'list');
    }

    return $this->redirect('formu/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->formulario = $this->getFormularioOrCreate();
    $this->updateFormularioFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveFormulario($formulario)
  {
    $formulario->save();
    LogInsert::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
    LogUpdate::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));

  }

  protected function deleteFormulario($formulario)
  {
    $formulario->delete();
    LogDelete::doBitacora($this->getUser()->getAttribute('nombrecompleto'), $this->getUser()->getAttribute('usr_ip'));
  }

  protected function updateFormularioFromRequest()
  {
    $formulario = $this->getRequestParameter('formulario');

    if (isset($formulario['pagina']))
    {
      $this->formulario->setPagina($formulario['pagina']);
    }
    if (isset($formulario['credencial']))
    {
      $this->formulario->setCredencial($formulario['credencial']);
    }
  }

  protected function getFormularioOrCreate($id_form = 'id_form')
  {
    if (!$this->getRequestParameter($id_form))
    {
      $formulario = new Formulario();
    }
    else
    {
      $formulario = FormularioPeer::retrieveByPk($this->getRequestParameter($id_form));

      $this->forward404Unless($formulario);
    }

    return $formulario;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/formulario');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/formulario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/formulario/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/formulario/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/formulario/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/formulario/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['pagina_is_empty']))
    {
      $criterion = $c->getNewCriterion(FormularioPeer::PAGINA, '');
      $criterion->addOr($c->getNewCriterion(FormularioPeer::PAGINA, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['pagina']) && $this->filters['pagina'] !== '')
    {
      $c->add(FormularioPeer::PAGINA, strtr($this->filters['pagina'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['credencial_is_empty']))
    {
      $criterion = $c->getNewCriterion(FormularioPeer::CREDENCIAL, '');
      $criterion->addOr($c->getNewCriterion(FormularioPeer::CREDENCIAL, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['credencial']) && $this->filters['credencial'] !== '')
    {
      $c->add(FormularioPeer::CREDENCIAL, strtr($this->filters['credencial'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/formulario/sort'))
    {
      $sort_column = FormularioPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/formulario/sort') == 'asc')
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
      'formulario{pagina}' => 'pagina:',
      'formulario{credencial}' => 'nombre del credencial:',
    );
  }
}
