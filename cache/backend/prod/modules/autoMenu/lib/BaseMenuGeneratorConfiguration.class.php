<?php

/**
 * menu module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage menu
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMenuGeneratorConfiguration extends sfTwitterModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getShowActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_edit' => NULL,);
  }

  public function getListParams()
  {
    return '%%menu_name%% - %%menu_eng%% - %%Parent%% - %%menu_state%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Menu List';
  }

  public function getEditTitle()
  {
    return 'Edit Menu';
  }

  public function getNewTitle()
  {
    return 'New Menu';
  }

  public function getShowTitle()
  {
    return 'Show Menu';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {

    return array(  0 => 'menu_name',  1 => 'menu_eng',  2 => 'Parent',  3 => 'menu_state',);
  }

  public function getShowDisplay()
  {

    return array(  0 => 'menu_id',  1 => 'menu_name',  2 => 'menu_eng',  3 => 'menu_parent',  4 => 'menu_ord',  5 => 'menu_desc',  6 => 'menu_state',);
  }

  public function getFieldsDefault()
  {
    return array(
      'menu_id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'menu_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Нэр',),
      'menu_eng' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Англи',),
      'menu_parent' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',  'label' => 'Үндсэн цэс',),
      'menu_ord' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Дараалал',),
      'menu_desc' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Тайлбар',),
      'menu_state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Хаяг',),
      'roles_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'Parent' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Үндсэн цэс',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }

  public function getFieldsShow()
  {
    return array(
      'menu_id' => array(),
      'menu_name' => array(),
      'menu_eng' => array(),
      'menu_parent' => array(),
      'menu_ord' => array(),
      'menu_desc' => array(),
      'menu_state' => array(),
      'roles_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'MenuForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'MenuFormFilter';
  }

  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();

    return $configuration;
  }

  protected function compile()
  {
    parent::compile();

    $config = $this->getConfig();

    // add configuration for the show view
    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                        ) ;

    foreach ($this->getShowDisplay() as $name) {
      list($field, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
      $field = new sfModelGeneratorConfigurationField($field, array_merge(
        array('type' => 'Text', 'label' => sfInflector::humanize(sfInflector::underscore($field))),
        isset($config['default'][$field]) ? $config['default'][$field] : array(),
        isset($config['show'][$field]) ? $config['show'][$field] : array(),
        array('flag' => $flag)
      ));

      $field->setFlag($flag);
      $this->configuration['show']['fields'][$name]  = $field;
      $this->configuration['show']['display'][$name] = $field;
    }

    foreach ($this->configuration['show']['actions'] as $action => $parameters) {
      $this->configuration['show']['actions'][$action] = $this->fixActionParameters($action, $parameters);
    }

    $this->parseVariables('show', 'title');
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {

    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }

  public function hasListPartial()
  {
    return false;
  }

  public function getListPartial()
  {
    return array();
  }

  public function hasEditPartial()
  {
    return false;
  }

  public function getEditPartial()
  {
    return array();
  }

  public function hasNewPartial()
  {
    return false;
  }

  public function getNewPartial()
  {
    return array();
  }

  public function hasShowPartial()
  {
    return false;
  }

  public function getShowPartial()
  {
    return array();
  }
}
