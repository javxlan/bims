<?php

require_once(dirname(__FILE__).'/../lib/BaseRolesGeneratorConfiguration.class.php');
require_once(dirname(__FILE__).'/../lib/BaseRolesGeneratorHelper.class.php');

/**
 * roles actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage roles
 * @author     ##AUTHOR_NAME##
 */
abstract class autoRolesActions extends sfActions
{
  public function preExecute()
  {
    $this->configuration = new rolesGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName()))) {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new rolesGeneratorHelper();
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page')) {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset')) {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@roles');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid()) {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@roles');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }


  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->roles = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->roles = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->roles = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->roles);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->roles = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->roles);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->delete()) {
      $this->getUser()->setFlash('notice', 'Бичлэгийг амжилттай устгалаа.');
    }

    $this->redirect('@roles');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids')) {
      $this->getUser()->setFlash('error', 'Ядаж нэг бичлэг сонгоно уу !');

      $this->redirect('@roles');
    }

    if (!$action = $request->getParameter('batch_action')) {
      $this->getUser()->setFlash('error', 'Хийх үйлдэлээ сонгоно уу !.');

      $this->redirect('@roles');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action))) {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action))) {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'roles'));
    try {
      // validate ids
      $ids = $validator->clean($ids);

      // execute batch
      $this->$method($request);
    } catch (sfValidatorError $e) {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
    }

    $this->redirect('@roles');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('roles')
      ->whereIn('role_id', $ids)
      ->execute();

    foreach ($records as $record) {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));

      $record->delete();
    }

    $this->getUser()->setFlash('notice', 'Сонгосон бичлэгүүдийг амжилттай устгалаа');
    $this->redirect('@roles');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'Мэдээллийг амжилттай үүсгэлээ.' : 'Мэдээллийг амжилттай засварлалаа.';

      try {
        $roles = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);

        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $roles)));

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@roles_new');
      } else {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'roles_edit', 'sf_subject' => $roles));
      }
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('roles.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('roles.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('roles');
    $pager->setQuery($this->buildQuery());
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('roles.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('roles.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters) {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  protected function addSortQuery($query)
  {
    if (array(null, null) == ($sort = $this->getSort())) {
      return;
    }

    if (!in_array(strtolower($sort[1]), array('asc', 'desc'))) {
      $sort[1] = 'asc';
    }

    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
  }

  protected function getSort()
  {
    if (null !== $sort = $this->getUser()->getAttribute('roles.sort', null, 'admin_module')) {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('roles.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1]) {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('roles.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return Doctrine_Core::getTable('roles')->hasColumn($column);
  }
}
