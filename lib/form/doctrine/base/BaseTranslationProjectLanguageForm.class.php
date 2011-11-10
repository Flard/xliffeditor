<?php

/**
 * TranslationProjectLanguage form base class.
 *
 * @method TranslationProjectLanguage getObject() Returns the current form's model object
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTranslationProjectLanguageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'project_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => false)),
      'name'       => new sfWidgetFormInputText(),
      'lang'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'project_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Project'))),
      'name'       => new sfValidatorString(array('max_length' => 50)),
      'lang'       => new sfValidatorString(array('max_length' => 5)),
    ));

    $this->widgetSchema->setNameFormat('translation_project_language[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TranslationProjectLanguage';
  }

}
