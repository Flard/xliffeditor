<?php

/**
 * Project filter form base class.
 *
 * @package    xliffeditor
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProjectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'token' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'  => new sfValidatorPass(array('required' => false)),
      'token' => new sfValidatorPass(array('required' => false)),
      'slug'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('project_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Project';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'name'  => 'Text',
      'token' => 'Text',
      'slug'  => 'Text',
    );
  }
}
