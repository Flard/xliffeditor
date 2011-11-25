<?php

/**
 * ResourceLineTranslation form base class.
 *
 * @method ResourceLineTranslation getObject() Returns the current form's model object
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResourceLineTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'line_id'     => new sfWidgetFormInputHidden(),
      'language_id' => new sfWidgetFormInputHidden(),
      'target_text' => new sfWidgetFormTextarea(),
      'remarks'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'line_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('line_id')), 'empty_value' => $this->getObject()->get('line_id'), 'required' => false)),
      'language_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('language_id')), 'empty_value' => $this->getObject()->get('language_id'), 'required' => false)),
      'target_text' => new sfValidatorString(array('required' => false)),
      'remarks'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_line_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceLineTranslation';
  }

}
