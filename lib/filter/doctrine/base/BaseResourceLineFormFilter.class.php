<?php

/**
 * ResourceLine filter form base class.
 *
 * @package    xliffeditor
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResourceLineFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'resource_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Resource'), 'add_empty' => true)),
      'source_text' => new sfWidgetFormFilterInput(),
      'remarks'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'resource_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Resource'), 'column' => 'id')),
      'source_text' => new sfValidatorPass(array('required' => false)),
      'remarks'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resource_line_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResourceLine';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'resource_id' => 'ForeignKey',
      'source_text' => 'Text',
      'remarks'     => 'Text',
    );
  }
}
