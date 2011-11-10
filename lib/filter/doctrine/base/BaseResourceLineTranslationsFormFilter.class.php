<?php

/**
 * ResourceLineTranslations filter form base class.
 *
 * @package    xliffeditor
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResourceLineTranslationsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'target_text' => new sfWidgetFormFilterInput(),
      'remarks'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'target_text' => new sfValidatorPass(array('required' => false)),
      'remarks'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_line_translations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceLineTranslations';
  }

  public function getFields()
  {
    return array(
      'line_id'     => 'Number',
      'language_id' => 'Number',
      'target_text' => 'Text',
      'remarks'     => 'Text',
    );
  }
}
