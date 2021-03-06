<?php

/**
 * Resource form base class.
 *
 * @method Resource getObject() Returns the current form's model object
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'project_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => false)),
      'name'             => new sfWidgetFormInputText(),
      'catalogue'        => new sfWidgetFormInputText(),
      'base_language_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BaseLanguage'), 'add_empty' => true)),
      'base_resource_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BaseResource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'project_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Project'))),
      'name'             => new sfValidatorString(array('max_length' => 50)),
      'catalogue'        => new sfValidatorString(array('max_length' => 50)),
      'base_language_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BaseLanguage'), 'required' => false)),
      'base_resource_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BaseResource'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Resource';
  }

}
