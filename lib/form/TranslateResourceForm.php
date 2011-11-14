<?php 

class TranslateResourceForm extends sfForm {

  protected $resource, $language;

  public function __construct(Resource $resource, ProjectLanguage $language) {
    $this->resource = $resource;
    $this->language = $language;
    parent::__construct();
  }

  public function setup() {
    foreach($this->resource->Lines as $line) {
      $name = $line->id;
      $value = $line->getTargetText($this->language->lang, '');

      $widget = new sfWidgetFormInputText(array('label' => $line->source_text, 'default' => $value));
      $validator = new sfValidatorString(array('required' => false));

      $this->setWidget($name, $widget);
      $this->setValidator($name, $validator);
    }
  }

}
