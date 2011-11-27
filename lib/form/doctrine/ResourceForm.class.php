<?php

/**
 * Resource form.
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ResourceForm extends BaseResourceForm
{
  public function configure()
  {
      $this->useFields(array('name', 'catalogue', 'base_language_id'));

      $q = ProjectLanguageTable::getInstance()->createQuery('pl');
      $q->addWhere('pl.project_id = ?', $this->getObject()->project_id);
      $this->widgetSchema['base_language_id']->setOption('query', $q);
      $this->validatorSchema['base_language_id']->setOption('query', $q);

  }
}
