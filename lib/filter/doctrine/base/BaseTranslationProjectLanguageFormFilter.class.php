<?php

/**
 * TranslationProjectLanguage filter form base class.
 *
 * @package    xliffeditor
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTranslationProjectLanguageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'project_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Project'), 'add_empty' => true)),
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lang'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'project_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Project'), 'column' => 'id')),
      'name'       => new sfValidatorPass(array('required' => false)),
      'lang'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('translation_project_language_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TranslationProjectLanguage';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'project_id' => 'ForeignKey',
      'name'       => 'Text',
      'lang'       => 'Text',
    );
  }
}
