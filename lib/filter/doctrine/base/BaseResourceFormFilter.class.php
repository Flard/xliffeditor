<?php

/**
 * Resource filter form base class.
 *
 * @package    xliffeditor
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'project_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => true)),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'catalogue'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'base_language_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BaseLanguage'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'project_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Project'), 'column' => 'id')),
      'name'             => new sfValidatorPass(array('required' => false)),
      'catalogue'        => new sfValidatorPass(array('required' => false)),
      'base_language_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('BaseLanguage'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('resource_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resource';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'project_id'       => 'ForeignKey',
      'name'             => 'Text',
      'catalogue'        => 'Text',
      'base_language_id' => 'ForeignKey',
    );
  }
}
